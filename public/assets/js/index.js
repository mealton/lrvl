const index = {
    action: "/ajax.php",

    uploaderInit() {
        let $this = this;
        let imageUploader = document.getElementById('image-uploader');

        if (!imageUploader)
            return false;

        document.body.addEventListener("paste", function (e) {
            if (e.clipboardData) {
                let items = e.clipboardData.items;
                for (let i = 0; i < items.length; i++) {
                    if (items[i].type.match(/image\//gi)) {
                        let blob = items[i].getAsFile();
                        let reader = new FileReader();
                        reader.readAsDataURL(blob);
                        reader.onloadend = () => {
                            $this.uploadImage(reader.result, this);
                            e.clipboardData.clearData("Text");
                        };
                    }
                }
            }
        });
    },

    uploadImage(base64) {

        let fileAttachment = $('.u-file-attach-v3');

        fileAttachment[0].classList.add('_preloader');
        let albumId = $('input[name="fileAttachment2[]"]').attr('data-albumid')

        let data = {
            method: 'base64_upload',
            base64,
            albumId
        };

        let jFiler = $('.js-result-list');
        if (!jFiler.length)
            fileAttachment
                .after(`<div class="jFiler-items jFiler-row">
                        <div class="js-result-list row"></div></div>`);

        let callback = response => {

            //console.log(response);

            fileAttachment[0].classList.remove('_preloader');

            if (!$('#image-uploader').height())
                $('#image-uploader-handler, #comment-uploader-handler').click();

            let jsList = $('.js-result-list');

            jsList.append(response.previews);

            if ($('.comment-uploader').length) {
                $('.fa.fa-pencil-square-o.cursor-pointer.ml-1').hide();
                $('input[name="commentImageId"]')[0].value = response.result;
            } else {
                if (!$('.js-result-buttons').length)
                    jsList.after(`<p class="js-result-buttons text-right mt-3">
                                    <button type="button" class="btn btn-primary rounded-0"  onclick="index.okFunc(this)">ОК</button>
                                    <button type="button" class="btn btn-secondary rounded-0" onclick="index.clearAll(this)">Отмена</button>
                                 </p>`);
                $('.album-container').prepend(response.images);
            }


        };
        return ajax(this.action, data, callback);
    },

    deleteImg(filename, id) {
        let data = {
            method: "delete_img",
            filename,
            id
        };
        let callback = response => {
            //console.log(response);

            if (response.result)
                $(`[data-id="${id}"]`).remove();

            if (!$('.js-result-list__preview-item').length)
                $('.js-result-buttons').remove();
        };
        ajax(this.action, data, callback);
    },

    okFunc() {
        let data = {
            method: 'telegram',
            id: document.querySelector(".j-image").dataset.id
        };
        let callback = response => {
            console.log(response);
        };
        $('.jFiler-items.jFiler-row').remove();
        ajax(this.action, data, callback);
    },

    clearAll() {
        let filenames = [];
        let ids = [];
        document.querySelectorAll('.js-result-list img.j-image').forEach(item => {
            filenames.push(item.dataset.filename);
            ids.push(item.dataset.id);
        });
        let data = {
            method: "clear_all",
            filenames,
            ids
        };
        let callback = response => {
            //console.log(response);
            if (!response.result)
                return false;
            this.okFunc();
            ids.forEach(id => $(`.album-container [data-id="${id}"]`).remove());
        };
        ajax(this.action, data, callback);
    },

    imgInfoModal(image, id) {
        let modal = $('#imageInfoModal');
        modal[0].dataset.imageid = id;
        modal[0].querySelectorAll('input, textarea').forEach(item => item.valueOf = "");
        modal[0].querySelector('img.modal-image').setAttribute('src', image);
        document.getElementById('image-info-modal-toggle').click();
    },

    updateImageInfo(item) {
        let id = $(item).closest('.modal')[0].dataset.imageid;
        let property = item.getAttribute('name');
        let value = item.value;

        let data = {method: 'update_image_info', id, property, value};

        let callback = response => {
            //console.log(response);
            item.classList.add('is-valid');
            setTimeout(() => item.classList.remove('is-valid'), 4000);
        };
        ajax(this.action, data, callback);
    },

    like(id) {
        let data = {method: 'like', id};

        let callback = response => {
            //console.log(response);

            let faIcon = document.querySelectorAll('.like-heart-icon');
            faIcon.forEach((icon) => {
                icon.className = `like-heart-icon mr-2 fa fa-heart${response.decrement ? "-o" : ""}`
            });

            document.querySelectorAll('.likes-chars').forEach(likes => {
                likes.querySelectorAll('.current-like-char').forEach((char, i, chars) => {

                    if (response.decrement) {
                        if (+char.innerText === 0 && chars[i - 1])
                            chars[i - 1].parentElement.classList.add('to-decrement');

                        if (i === chars.length - 1)
                            char.parentElement.classList.add('to-decrement');
                    } else {
                        if (+char.innerText === 9 && chars[i - 1])
                            chars[i - 1].parentElement.classList.add('to-increment');

                        if (i === chars.length - 1)
                            char.parentElement.classList.add('to-increment');
                    }
                });

                setTimeout(() => likes.innerHTML = response.likes_html, 400);
            });


        };
        ajax(this.action, data, callback);
    },

    getImage(id, modal = false) {

        if (!id)
            return false;

        let data = {
            method: 'get_image_by_id',
            id,
            //imageWidth: document.querySelector('.image').offsetWidth,
            modal,
            filter: FILTER,
            draggable: this.imageIsDraggable
        };

        let mainContent = document.querySelector('#main-content');
        mainContent.classList.add('_preloader');
        let mainModalImage = document.querySelector('.main-modal-image');
        mainModalImage.classList.add('_preloader');
        let callback = response => {
            console.log(data, response);
            mainContent.classList.remove('_preloader');
            mainModalImage.classList.remove('_preloader');
            history.pushState(null, null, "/images/" + id + (modal ? "#image-modal" : ""));

            document.title = response.meta.title;

            const head = document.head;

            head.querySelector('meta[name="description"]').setAttribute("content", response.meta.description);
            head.querySelector('meta[name="keywords"]').setAttribute("content", response.meta.keywords);
            head.querySelector('meta[name="author"]').setAttribute("content", response.meta.author);
            head.querySelector('meta[property="og:url"]').setAttribute("content", response.meta.url);
            head.querySelector('meta[property="og:image"]').setAttribute("content", response.meta.image);

            head.querySelector('meta[property="og:image:width"]').setAttribute("content", response.meta.image_meta.width);
            head.querySelector('meta[property="og:image:height"]').setAttribute("content", response.meta.image_meta.height);

            document.getElementById('main-content').innerHTML = response.html;

            window.scrollTo({top: 0, behavior: 'smooth'});

            let editorForm = document.getElementById('editor-form')
            if (editorForm)
                index.editorInit(editorForm)


            $.GSCore.components.GSFileAttachment.init('.js-file-attachment');
            this.modalCursorInit();

        };
        ajax(this.action, data, callback);
    },

    showImgModal() {
        let modal = document.getElementById("image-modal");
        modal.style.display = "block";
        document.body.style.overflow = "hidden";
        history.pushState(null, null, location.pathname + "#image-modal");
        window.addEventListener('wheel', this.modalWheel, {passive: false});
    },

    hideImgModal() {
        let modal = document.getElementById("image-modal");
        if (!modal)
            return false;
        modal.style.display = "none";
        document.body.style.overflow = "initial";
        history.pushState(null, null, location.pathname);
    },

    imageIsDraggable:false,

    dragabble(image) {
        let zoomer = document.querySelector('.fa.zoomer');
        if (!image.classList.contains('draggable') && image.offsetWidth < image.naturalWidth) {
            $(image).draggable().addClass('draggable').css({position: 'relative', left: 'initial', top: 'initial'});
            $(image).draggable('enable');
            zoomer.classList.add('fa-search-minus');
            this.imageIsDraggable = true;
        } else {
            $(image).draggable().removeClass('draggable').css({position: 'static'});
            $(image).draggable('disable');
            zoomer.classList.remove('fa-search-minus');
            this.imageIsDraggable = false;
        }

    },

    auth(form) {
        let data = {
            method: 'auth',
            login: {
                required: form.elements.login.dataset.required,
                label: form.elements.login.dataset.label,
                value: form.elements.login.value.trim(),
            },
            password: {
                required: form.elements.password.dataset.required,
                label: form.elements.password.dataset.label,
                value: form.elements.password.value.trim(),
            },
        };
        let callback = response => {
            //console.log(response);

            if (!response.result) {
                if (response.error && response.property) {
                    let input = form.elements[response.property];
                    input.classList.add('is-invalid');
                    input.nextElementSibling.innerHTML = response.error;

                    input.onfocus = () => {
                        input.classList.remove('is-invalid');
                        input.nextElementSibling.innerHTML = "";
                    };
                } else {
                    let resultFeedback = form.querySelector('.result-feedback');
                    resultFeedback.style.display = "block";
                    resultFeedback.innerHTML = "Пользователь не найден";
                    setTimeout(() => resultFeedback.style.display = "none", 6000);
                }
                return false;
            }

            location.href = form.elements.referer.value;

        };
        return ajax(this.action, data, callback);
    },

    scrollBlock: false,

    modalWheel(e) {

        if (!document.getElementById('image-modal').offsetHeight)
            return false;

        e.preventDefault();

        if (this.scrollBlock)
            return false;

        let prevBtn = document.querySelector("#image-modal .image-prev");
        let nextBtn = document.querySelector("#image-modal .image-next");

        e.deltaY < 0
            ? (prevBtn ? prevBtn.click() : index.hideImgModal())
            : (nextBtn ? nextBtn.click() : index.hideImgModal());

        this.scrollBlock = true;
        setTimeout(() => this.scrollBlock = false, 500);
    },

    editorData: {
        album_id: null,
        description: "",
        author: "",
        image: "",
        text: "",
        hashtags: [],
        source: "",
        new: {
            album: {name: "", parent: null},
            imageBase64: "",
        }
    },

    editorInit(form) {

        let formData = form.elements;

        this.editorData.album_id = +formData.album_id.value;
        this.editorData.description = formData.description.value;
        this.editorData.author = formData.author.value;
        this.editorData.image = formData.image.value.split("/").pop();
        this.editorData.text = formData.text.value;
        this.editorData.hashtags = formData.hashtags.value.split(",");
        this.editorData.source = formData.source.value;


        let uploader = base64 => {
            form.querySelector('img.image').setAttribute('src', base64);
            this.editorData.new.imageBase64 = base64;
        }

        document.querySelectorAll('textarea')
            .forEach(textarea => textareaAuthHeight(textarea));

        document.querySelector(".editor-uploader [type='file']").onchange = (e) => {
            Object.values(e.target['files']).forEach(file => {
                let reader = new FileReader();
                reader.onload = () => {
                    uploader(reader.result);
                };
                reader.readAsDataURL(file);
            });
        };

        document.querySelector('.editor-uploader [name="on-paste"]')
            .addEventListener("paste", function (e) {
                if (e.clipboardData) {
                    let items = e.clipboardData.items;
                    if (items && !this.value) {
                        for (let i = 0; i < items.length; i++) {
                            if (items[i].type.indexOf("image") !== -1) {
                                let blob = items[i].getAsFile();
                                let reader = new FileReader();
                                reader.readAsDataURL(blob);
                                reader.onloadend = () => {
                                    uploader(reader.result);
                                    e.clipboardData.clearData("Text");
                                };
                            }
                        }
                    }
                }
            });
    },

    changeAlbum(item) {
        this.editorData.album_id = item.dataset.id;
        document.getElementById('album-label').innerHTML = item.innerHTML;
        $(item).closest('.modal-content').find('.btn-close').click();
    },

    changeAuthor(item) {
        this.editorData.author = item.innerHTML;
        document.querySelector('input[name="author"]').value = item.innerHTML;
        $(item).closest('.modal-content').find('.btn-close').click();
    },

    changeHashtags(item) {
        let modal = $(item).closest('.modal')[0];
        let input = modal.querySelector('input[name="newHashtags"]');
        let selectedCheckboxes = modal.querySelectorAll('input[type="checkbox"]:checked');

        let hashtags = [];
        selectedCheckboxes.forEach(checkbox => hashtags.push(checkbox.value));
        if (input.value.trim())
            hashtags = hashtags.concat(input.value.split(',').map(item => item.trim()));
        this.editorData.hashtags = hashtags;

        let hashtagsHTML = hashtags.map(tag =>
            `<a class="u-tags-v1 mb-2 g-font-size-12 g-brd-around g-brd-gray-light-v4 g-bg-primary--hover g-brd-primary--hover g-color-black-opacity-0_8 g-color-white--hover rounded g-py-6 g-px-15 g-mr-5"
                href="/tag/${tag}">${tag}</a>`);
        document.querySelector('.hashtags-inner').innerHTML = hashtagsHTML.join('');
        $(item).closest('.modal-content').find('.btn-close').click();
    },

    addAlbum(input) {
        this.editorData.new.album.name = input.value;
        document.getElementById('album-label').innerHTML = input.value;
    },

    editorSubmit(id) {
        let data = this.editorData;
        data.method = 'update_image';
        data.id = id;

        let callback = response => {

            //console.log(response);

            if (response.result)
                return this.getImage(id);
        };

        return ajax(this.action, data, callback);
    },

    editorchangeStatus(btn, status, id) {
        let data = {
            method: 'set_image_status',
            status,
            id
        };
        let callback = response => {
            let button = document.createElement('button');
            button.className = "btn rounded-0 btn-info";

            if (status === 1) {
                button.setAttribute("onclick", "index.editorchangeStatus(this, 0)");
                button.innerHTML = "Не отображать изображение";
            } else {
                button.setAttribute("onclick", "index.editorchangeStatus(this, 1)");
                button.innerHTML = "Отображать изображение";
            }
            btn.parentNode.replaceChild(button, btn);
            $('img.image').closest('figure')[0].classList.toggle('is-deleted');
        };
        return ajax(this.action, data, callback);
    },

    deleteImage(id, nextId, albumId) {
        let data = {
            method: 'delete_image',
            id
        };
        let callback = response => {
            if (!response.result)
                return alert('Ошибка!!!');

            if (nextId)
                return this.getImage(nextId);
            else
                location.href = "/albums/" + albumId;

        };

        if (!confirm("Вы, действительно, хотите удалить данное изображение?"))
            return false;

        return ajax(this.action, data, callback);
    },

    hashtagsFilter(value) {
        let hashtags = document.querySelectorAll(".hashtags-checkbox-item");
        $(hashtags).show();

        if (!value)
            return true;

        hashtags.forEach(item => {
            let regExp = new RegExp(`^${value}`, "gi");
            if (!item.dataset.value.match(regExp))
                $(item).hide();
        });
    },

    albumChangeStatus(item, status, id) {
        let data = {
            method: 'set_image_status',
            status,
            id
        };
        let callback = response => {
            //console.log(response);

            if (!response.result)
                return false;

            item.className = `pointer fa fa-${status ? 'check-' : ''}square-o`;
            $(item).closest('.grid-item')[0].classList.toggle('is-deleted');
        };
        return ajax(this.action, data, callback);
    },

    albumDeleteImage(item, id) {
        let data = {
            method: 'delete_image',
            id
        };
        let callback = response => {
            if (!response.result)
                return alert('Ошибка!!!');

            $(item).closest('.grid-item').remove();
        };

        if (!confirm("Вы, действительно, хотите удалить данное изображение?"))
            return false;

        return ajax(this.action, data, callback);
    },

    albumStatus(item, status, id) {
        let data = {
            method: 'set_album_status',
            status,
            id
        };
        let callback = response => {
            //console.log(response);

            if (!response.result)
                return false;

            item.className = `pointer fa fa-${status ? 'check-' : ''}square-o`;
            $(item).closest('.grid-item, .sub-item')[0].classList.toggle('is-deleted');
        };
        return ajax(this.action, data, callback);
    },

    showAlbumNameModal(icon, id) {
        const oldName = $(icon).closest('.album-container').find('.album-name').html();
        const modal = $('#albumNameModal');
        modal.find('input[name="albumName"]').val(oldName)
        modal.find('input[name="albumId"]').val(id);
        modal.modal('show');
    },

    albumName(btn) {
        let modal = $(btn).closest('.modal');
        let id = +modal.find('input[name="albumId"]').val();

        if (!id)
            return alert("Ошибка!!! Не передан идентификатор альбома!!!");

        let name = modal.find('input[name="albumName"]').val().trim();

        if (!name)
            return alert("Ошибка!!! Имя альбома не может быть пустым!!!");

        let data = {
            method: 'update_album_name',
            name,
            id
        };
        let callback = response => {
            console.log(response);

            if (!response.result)
                return false;

            modal.modal('hide');
            let gridItem = $(`.album-container[data-id="${id}"]`);
            gridItem.find(".album-name").html(name);

        };
        return ajax(this.action, data, callback);
    },

    albumDelete(item, id) {
        let data = {
            method: 'delete_album',
            id
        };
        let callback = response => {
            //console.log(response);
            $(item).closest('.grid-item').remove();
        };

        if (!confirm("Вы, действительно, хотите удалить данный альбом?"))
            return false;

        return ajax(this.action, data, callback);
    },

    addHashtagModalInfo(btn) {
        let input = $('#imageInfoModal input[name="hashtags"]')[0];
        let tag = btn.innerHTML.trim();
        btn.style.background = "green";

        if (!input.value.trim())
            input.value = tag;
        else
            input.value += `, ${tag}`;

        $(btn).closest('.u-accordion__body').find('.input-clear').click();
        this.updateImageInfo(input);
        btn.remove();
    },

    hashtagsFilterModalInfo(value) {
        let hashtags = document.querySelectorAll(".hashtag-btn-item");
        $(hashtags).show();

        if (!value)
            return true;

        hashtags.forEach(item => {
            let regExp = new RegExp(`^${value}`, "gi");
            if (!item.innerText.trim().match(regExp)) $(item).hide();
        });
    },

    addSub(btn) {
        let formGroup = btn.parentElement;
        let parent = formGroup.querySelector('input[name="parent"]').value;
        let nameInput = formGroup.querySelector('input[name="subName"]');

        if (!nameInput.value.trim()) {
            nameInput.classList.add('is-invalid');
            nameInput.onfocus = () => nameInput.classList.remove('is-invalid');
            return false;
        }

        let data = {
            method: 'add_sub',
            name: nameInput.value.trim(),
            parent
        };

        let callback = response => {
            //console.log(response);
            //$('#add-sub-btn').before(response.sub);

            if (+parent)
                $('.subs-list').append(response.sub);
            else
                $('.albums-container').append(response.sub);

            $(btn).closest('.modal-content').find('.btn-close').click();
        };
        return ajax(this.action, data, callback);
    },

    comment(form) {
        let data = {
            method: 'comment',
            username: form.elements.username.value.trim(),
            comment: form.elements.comment.value.trim(),
            comment_image_id: form.elements.commentImageId.value,
            image_id: form.elements.imageId.value
        };

        if (!data.comment && !data.comment_image_id) {
            form.elements.comment.classList.add('is-invalid');
            form.elements.comment.onfocus = e => e.target.classList.remove('is-invalid');
            return false;
        }

        let callback = response => {
            //console.log(response);

            if (!response.result)
                return false;

            form.reset();
            $('.comments-container').prepend(response.comment);
            $('.js-result-list.row')[0].innerHTML = "";
        };

        return ajax(this.action, data, callback);

    },

    swiper(element) {
        swiper.init(element)
    },

    timeToHideCursor: 4000,

    modalCursorInit() {

        let modalInner = document.querySelector('.modal__inner');
        let onmousestop = () => modalInner.classList.add('no-cursor'), thread;

        $(modalInner)
            .on('mouseenter', () => setTimeout(onmousestop, this.timeToHideCursor))
            .on('mousemove', () => {
                modalInner.classList.remove('no-cursor');
                thread && clearTimeout(thread);
                thread = setTimeout(onmousestop, this.timeToHideCursor);
            });
    }

};

document.addEventListener("DOMContentLoaded", () => {

    index.uploaderInit();

    let modalInner = document.querySelector('.modal__inner');

    if (modalInner) window.addEventListener('wheel', index.modalWheel, {passive: false});


    document.body.onkeyup = e => {
        let imageModal = document.getElementById('image-modal');
        if (e.code === "Escape" && imageModal && imageModal.offsetHeight)
            index.hideImgModal();
    }

    /* document.body.onclick = e => {
         if (!$(e.target).closest('.image , .modal-control').length)
             index.hideImgModal();
     }*/

    index.modalCursorInit();

    const albumNameInput = document.querySelector('input[name="albumName"]');

    if (albumNameInput)
        albumNameInput.addEventListener('focus', event => event.target.select());

    const updateBtn = document.getElementById('update-btn');

    if(updateBtn){
        const imageId = updateBtn.dataset.id;
        document.addEventListener('keydown', function (e) {
            if (e.keyCode === 83 && e.ctrlKey && +imageId) {
                e.preventDefault();
                index.editorSubmit(imageId);
            }
        });
    }



    window.onscroll = () => {
        let scrollTop = this.pageYOffset;
        let lift = document.getElementById('lift');
        let liftOnclick = e => e.target.classList.contains('visible') ? this.scrollTo({top: 0}) : false;
        if (scrollTop > 1000) {
            lift.classList.add('visible');
            lift.addEventListener("click", liftOnclick);
        } else {
            lift.classList.remove('visible');
            lift.removeEventListener('click', liftOnclick);
        }
    };


    setInterval(() => {
        let date = new Date();
        let hours = date.getHours();
        if (+hours < 10)
            hours = '0' + hours;
        let minutes = date.getMinutes();
        if (+minutes < 10)
            minutes = '0' + minutes;
        let timer = document.getElementById('header-timer')
        let time = timer.innerHTML;
        let currentTime = hours + ":" + minutes;

        if (time !== currentTime)
            timer.innerHTML = currentTime;

    }, 1000);

});

