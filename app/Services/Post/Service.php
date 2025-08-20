<?php


namespace App\Services\Post;

use App\Models\Category;
use App\Models\Hashtag;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class Service
{

    private $post = null;

    private function post_converter($posts)
    {
        foreach ($posts as $i => $item) {

            $posts[$i]->date = $this->date_formatter($item->created_at, ['time' => 1]);

            if ($item->image_default) {
                $posts[$i]->image = $item->image_default;
                continue;
            }

            $contents = current((array)$item->contents);
            $images = array_filter($contents, function ($item) {
                return $item['tag'] == "image" && $item['is_active'] == 1 && $item['deleted_at'] == null;
            });
            $images = array_values($images);
            $posts[$i]->image = $images[rand(0, count($images) - 1)]->content;
        }
        return $posts;
    }

    public function index($filter, $per_page)
    {
        $posts = Post::
        with('contents')
            ->filter($filter)
            ->where(['is_published' => 1, 'is_deleted' => 0, 'moderated' => 1, 'deleted_at' => null])
            ->groupBy('id')
            ->orderByDesc('created_at')
            ->paginate($per_page);

        return $this->post_converter($posts);
    }

    public function top_categories()
    {
        $where = ['parent_id' => 0, 'is_active' => 1];
        $chunkSize = ceil(Category::where($where)->count() / 2);
        $firstChunk = Category::where($where)->take($chunkSize)->get();
        $secondChunk = Category::where($where)->skip($chunkSize)->take($chunkSize)->get();
        return [$firstChunk, $secondChunk];
    }

    public function show($post)
    {
        $this->post = $post;
        foreach ($post->comments as $i => $comment) {
            $content_item = $image = DB::table('contents')
                ->where(['tag' => 'comment', 'publication_id' => $comment->id])
                ->get()
                ->first();
            if ($content_item)
                $post->comments[$i]->image = $content_item->content;
        }

        if (!session('viewed-' . $post->id)) {
            $post->update(['views' => $post->views + 1]);
            session(['viewed-' . $post->id => true]);
        }

        $post->date = $this->date_formatter($post->created_at, ['time' => 1]);
        $post->relatives = $this->relatives($post->id);

        return $post;
    }

    public function breadcrumbs($category_id, $breadcrumb = [])
    {
        $query = DB::table('categories')
            ->where(['id' => $category_id, 'is_active' => 1])
            ->limit(1)
            ->get()
            ->first();

        if (empty((array)$query)) {
            $breadcrumb = array_merge(
                [['name' => 'Главная', 'url' => route("post.index")]],
                $breadcrumb
            );

            if (!$this->post)
                $breadcrumb[count($breadcrumb) - 1]['current'] = 1;
            else {
                $breadcrumb[] = [
                    'name' => html_entity_decode(@$this->post->title),
                    'current' => 1
                ];
            }

            return $breadcrumb;
        }

        array_unshift($breadcrumb, [
            'name' => html_entity_decode($query->name),
            'position' => count($breadcrumb) + 1,
            'url' => route("post.index") . "?category=" . $query->id
        ]);

        return $this->breadcrumbs($query->parent_id, $breadcrumb);
    }

    private static function date_formatter($date, $options = [])
    {
        $date = date_parse($date);
        $months = [1 => 'Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря'];
        $month = @$options['upper'] ? $months[$date['month']] : mb_strtolower($months[$date['month']]);
        $time = (bool)@$options['time'];
        $year_g = (bool)@$options['year'];
        $delimiter = @$options['delimiter'] ? $options['delimiter'] : ', ';

        return $date['day'] . ' ' . $month . ' ' . $date['year'] . ($year_g ? ' г.' : '') .
            ($time ? $delimiter . $date['hour'] . ':' . (intval($date['minute']) < 10 ? '0' . $date['minute'] : $date['minute']) : '');
    }

    private function relatives($post_id)
    {
        $hashtags = Hashtag::where(['publication_id' => $post_id])->get("name")->toArray();
        $hashtags = implode('", "', array_column($hashtags, "name"));
        $sql = <<<SQL
SELECT 
    `p`.*,
    `cat`.`is_hidden`,
    IF(`p`.`image_default` != "", `p`.`image_default`, 
        (SELECT `content` 
            FROM `contents` 
            WHERE `publication_id` = `p`.`id` 
                AND `tag` = "image" 
                AND `content` != "" 
                AND `is_active` = 1 
            ORDER BY RAND() LIMIT 1)) as `image`,
    (SELECT COUNT(*) FROM `hashtags` WHERE `name` IN ("$hashtags") AND `publication_id` = `p`.`id`) as `tags_counter`,
    (SELECT COUNT(`id`) FROM `comments` WHERE `publication_id` = `p`.`id` AND `is_active` = 1) as `comment_count`
FROM `posts` as `p`
    RIGHT JOIN `hashtags` as `h` ON  `p`.`id` = `h`.`publication_id` AND `h`.`name` IN ("$hashtags") AND `h`.`publication_id` != $post_id
    RIGHT JOIN `categories` as `cat` ON `p`.`category_id` = `cat`.`id` AND `cat`.`is_active` = 1
WHERE `p`.`id` != $post_id AND `p`.`is_published` = 1 AND `p`.`is_deleted` = 0 AND `p`.`moderated` = 1
GROUP BY `p`.`id`
HAVING `tags_counter` > 0 
ORDER BY `tags_counter` DESC
LIMIT 6
SQL;

        $result = DB::select($sql);

        if (empty($result)) {
            $sql = <<<SQL
SELECT 
    `p`.*,
    `cat`.`is_hidden`,
    IF(`p`.`image_default` != "", `p`.`image_default`, 
        (SELECT `content` 
            FROM `contents` 
            WHERE `publication_id` = `p`.`id` 
                AND `tag` = "image" 
                AND `content` != "" 
                AND `is_active` = 1 
            ORDER BY RAND() LIMIT 1)) as `image`,
    (SELECT COUNT(`id`) FROM `comments` WHERE `publication_id` = `p`.`id` AND `is_active` = 1) as `comment_count`
FROM `posts` as `p`
    RIGHT JOIN `categories` as `cat` ON `p`.`category_id` = `cat`.`id` AND `cat`.`is_active` = 1
WHERE `p`.`id` != $post_id AND `p`.`is_published` = 1 AND `p`.`is_deleted` = 0 
  AND `p`.`moderated` = 1 AND `p`.`category_id` = (SELECT `category_id` FROM `posts` WHERE `id` = $post_id LIMIT 1)
GROUP BY `p`.`id`
ORDER BY `created_at` DESC
LIMIT 6
SQL;

            $result = DB::select($sql);
        }

        return $result;

    }

    public function top_posts()
    {

        $sql = <<<SQL
SELECT 
    `p`.*,
    `cat`.`is_hidden`,
    IF(`p`.`image_default` != "", `p`.`image_default`, 
        (SELECT `content` 
            FROM `contents` 
            WHERE `publication_id` = `p`.`id` 
                AND `tag` = "image" 
                AND `content` != "" 
                AND `is_active` = 1 
            ORDER BY RAND() LIMIT 1)) as `image`,
    (SELECT COUNT(`id`) FROM `comments` WHERE `publication_id` = `p`.`id` AND `is_active` = 1) as `comment_count`
FROM `posts` as `p`
    RIGHT JOIN `categories` as `cat` ON `p`.`category_id` = `cat`.`id` AND `cat`.`is_active` = 1
WHERE `p`.`likes` > 2 AND `p`.`views` > 10 AND `p`.`is_published` = 1 AND `p`.`is_deleted` = 0 AND `p`.`moderated` = 1
ORDER BY `likes` DESC, `views` DESC
LIMIT 6
SQL;
        return DB::select($sql);
    }

    public static function get_youtube_video_id($url)
    {
        if (stristr($url, 'youtu.be/')) {
            preg_match('/(https:|http:|)(\/\/www\.|\/\/|)(.*?)\/(.{11})/i', $url, $final_ID);
            return $final_ID[4];
        } else {
            @preg_match('/(https:|http:|):(\/\/www\.|\/\/|)(.*?)\/(embed\/|watch.*?v=|)([a-z_A-Z0-9\-]{11})/i', $url, $IDD);
            return $IDD[5];
        }
    }

    public function get_route()
    {
        $namespace = (string)trim(request()->route()->action['namespace']);
        $_namespace = explode("\\", $namespace);
        return end($_namespace);
    }


}
