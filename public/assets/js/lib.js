function ffetch(action, callback, data, callback_error = () => false) {
    fetch(action, {
        method: 'post',
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(result => callback(result))
        .catch(error => callback_error(error));
}

let ajax = (action, data, callback) => {
    $.ajax({
        url: action,
        method: 'post',
        dataType: 'json',
        data: data,
        async: true,
        success: callback
    })
};


function formExecute(form) {
    const fields = form.elements;
    const data = {};
    for (let i in fields) {
        let field = fields[i];
        if (['SELECT', 'TEXTAREA', 'INPUT'].includes(field.tagName) && field.type !== 'submit') {
            if (['checkbox', 'radio'].includes(field.type)) {
                if (!field.checked)
                    continue;
                else
                    data[field.name] = field.value ? field.value : 1;
            } else
                data[field.name] = field.value;
        }
    }
    return data;
}

function formExecuteLabeled(form) {
    let fields = form.elements;
    let data = {};
    for (let i in fields) {
        let field = fields[i];
        if (['SELECT', 'TEXTAREA', 'INPUT'].includes(field.tagName) && field.type !== 'submit') {
            if (['checkbox', 'radio'].includes(field.type)) {
                if (!field.checked)
                    continue;
                else
                    data[field.name] = [{
                        value: field.value ? field.value : 1,
                        label: field.getAttribute('placeholder')
                    }];
            } else
                data[field.name] = [{value: field.value, label: field.getAttribute('placeholder')}];
        }
    }
    return data;
}

function parseQuery(url = false) {
    const queryString = url ?
        url.split('?')[1] :
        window.location.href.split('?')[1];
    if (queryString === undefined)
        return false;
    const result = {};
    const queryArray = queryString.split('&');
    queryArray.forEach(item => {
        const exp = item.split('=');
        result[exp[0]] = exp[1];
    });
    return result;
}

function arrayShuffle(array) {
    const result = [];
    while (result.length < array.length) {
        let index = Math.round(Math.random() * array.length - .5);
        if (result.indexOf(array[index]) === -1)
            result.push(array[index]);
    }
    return result;
}

function getRandomInt(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min;
}


function uploadFile(action, file, callback, before = () => {
}) {
    let formData = new FormData();
    if (file.files.length > 0)
        $.each(file.files, (i, file) => formData.append("file[" + i + "]", file));
    else
        return false;

    formData.append('folder', file.dataset.folder)

    $.ajax({
        type: "POST",
        url: action,
        cache: false,
        dataType: "JSON",
        contentType: false,
        processData: false,
        data: formData,
        beforeSend: function () {
            before();
        },
        success: function (response) {
            callback(response);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
        }
    });
}


function youtubePlayer(url, playerId) {
    const video = url.split('/');
    const videoId = video[video.length - 1].replace(/\?.*/, '');
    const tag = document.createElement('script');
    tag.src = "https://www.youtube.com/player_api";
    const firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    const containerWidth = $(`#${playerId}`).closest('div').innerWidth();
    const videoWidth = containerWidth;
    const videoHeigth = containerWidth / 1280 * 720;

    const videoQuery = parseQuery(url);

    setTimeout(function () {
        return new YT.Player(playerId, {
            width: videoWidth,
            height: videoHeigth,
            videoId: videoId,
            playerVars: {
                start: videoQuery.t ? videoQuery.t : 0
            }
        });
    }, 500);
}


function getElemetsAttributes(elements, attributes = []) {
    if (typeof attributes !== 'object')
        attributes = [attributes];

    const data = {};

    if (!(elements instanceof jQuery))
        elements = $(elements);

    elements.each((i, element) => {
        attributes.forEach(attribute => {
            if (data[attribute])
                data[attribute].push(element[attribute]);
            else
                data[attribute] = [element[attribute]]
        });
    });

    return data;
}


function copyToClipboard(text, context = false) {
    let textField = document.createElement('textarea');
    textField.innerHTML = text;

    if (context)
        context.parentNode.insertBefore(textField, context);
    else
        document.body.appendChild(textField);

    textField.select();
    document.execCommand('copy');
    textField.parentNode.removeChild(textField);
}


function validateInput(input, errorText, invalid = true, onlyOnFalse = false) {
    if (invalid) {
        input.className = `form-control is-invalid`;
        input.nextElementSibling.innerHTML = errorText;
        input.nextElementSibling.style.display = 'block';
    } else {
        if (!onlyOnFalse)
            input.className = `form-control is-valid`;
        input.nextElementSibling.innerHTML = '';
        input.nextElementSibling.style.display = 'none';
    }
}


function addLink() {
    var body_element = document.getElementsByTagName('body')[0];
    var selection = window.getSelection();
    var pagelink = `<br>Подробнее на <a href="${document.location.href}">${document.location.href}</a> &copy;`;
    var copytext = selection + pagelink;
    var newdiv = document.createElement('div');
    newdiv.style.position = 'absolute';
    newdiv.style.left = '-99999px';
    body_element.appendChild(newdiv);
    newdiv.innerHTML = copytext;
    selection.selectAllChildren(newdiv);
    window.setTimeout(function () {
        body_element.removeChild(newdiv);
    }, 0);
}

function showAllText(btn) {
    $(btn)
        .hide()
        .closest('.details').prev('.hidden').show();
}


function haveCommonElements(array1, array2) {
    const set1 = new Set(array1);
    const set2 = new Set(array2);

    // Check for intersection
    for (let elem of set1) {
        if (set2.has(elem)) {
            return true;
        }
    }
    return false;
}


let cookie = {

    get(name) {
        const results = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
        return results ? unescape(results[2]) : null;
    },

    set(name, value, exp_y, exp_m, exp_d, path, domain, secure) {
        let cookie_string = name + "=" + escape(value);

        if (exp_y) {
            const expires = new Date(exp_y, exp_m, exp_d);
            cookie_string += "; expires=" + expires.toGMTString();
        }

        if (path)
            cookie_string += "; path=" + escape(path);

        if (domain)
            cookie_string += "; domain=" + escape(domain);

        if (secure)
            cookie_string += "; secure";

        document.cookie = cookie_string;
    },

    delete(name) {
        const cookie_date = new Date();
        cookie_date.setTime(cookie_date.getTime() - 1);
        document.cookie = name += "=; expires=" + cookie_date.toGMTString();
    }
};

function textareaAuthHeight(textarea) {
    return textarea.style.height = textarea.scrollHeight + 10 + "px";
}


let swiper = {
    touchStart: null,
    touchEnd: null,
    swipeDistance: 100,
    init(element, callbackPrev, callbackNext) {
        element.ontouchstart = event => this.touchStart = event.touches[0];
        element.ontouchmove = event => this.touchEnd = event.touches[0];
        element.ontouchend = () => this.exec(callbackPrev, callbackNext);

        let zoomer = document.querySelector('.fa.zoomer');

        // if (zoomer && screen.width > 999 && element.naturalWidth > element.offsetWidth && element.offsetWidth > 0)
        //     zoomer.classList.remove('d-none');

    },
    exec(callbackPrev, callbackNext) {
        if (this.touchEnd) {
            if (+this.touchStart.clientX < +this.touchEnd.clientX - +this.swipeDistance) {
                this.touchStart = null;
                this.touchEnd = null;
                return callbackPrev();
            } else if (+this.touchStart.clientX > +this.touchEnd.clientX + +this.swipeDistance) {
                this.touchStart = null;
                this.touchEnd = null;
                return callbackNext();
            } else if (
                Math.abs(+this.touchStart.clientX - +this.touchEnd.clientX) < +this.swipeDistance &&
                Math.abs(+this.touchStart.clientY - +this.touchEnd.clientY) > +this.swipeDistance
            ) {
                let modalCloseBtn = document.querySelector(".close-modal");
                if (modalCloseBtn) {
                    this.touchStart = null;
                    this.touchEnd = null;
                    return $(modalCloseBtn).click();
                }
            }
        }
    }
};