@servers(['sweb' => '{{ env('SERVER') }}'])

@task('deploy', ['on' => 'sweb'])
    cd {{ env('PATH') }}
    set -e
    echo "Deploying..."
    git pull origin master
    php8.2 artisan down
    php8.2 composer.phar install --no-dev --optimize-autoloader
    php8.2 artisan migrate --force
    php8.2 artisan config:cache
    php8.2 artisan event:cache
    php8.2 artisan route:cache
    php8.2 artisan view:cache
    php8.2 artisan up
    echo "Done!"
@endtask
