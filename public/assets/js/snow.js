window.onload = () => {
    let style = document.createElement('style');
    style.innerHTML = `
.snowContainer {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
}

#snow {
    width: 100%;
    height: 100%;
    background-image: url("https://mealton.ru/snowImg/snow_1.png"), url("https://mealton.ru/snowImg/snow_2.png"), url("https://mealton.ru/snowImg/snow_3.png");
    -webkit-animation: snow 20s linear infinite;
    -moz-animation: snow 20s linear infinite;
    -ms-animation: snow 20s linear infinite;
    animation: snow 20s linear infinite;
}

@keyframes snow {
    0% {
        background-position: 0 0, 0 0, 0 0;
    }
    100% {
        background-position: 500px 1000px, 400px 400px, 300px 300px;
    }
}

@-moz-keyframes snow {
    0% {
        background-position: 0 0, 0 0, 0 0;
    }
    100% {
        background-position: 500px 1000px, 400px 400px, 300px 300px;
    }
}

@-webkit-keyframes snow {
    0% {
        background-position: 0 0, 0 0, 0 0;
    }
    100% {
        background-position: 500px 1000px, 400px 400px, 300px 300px;
    }
}

@-ms-keyframes snow {
    0% {
        background-position: 0 0, 0 0, 0 0;
    }
    100% {
        background-position: 500px 1000px, 400px 400px, 300px 300px;
    }
}`;
    document.head.append(style);
    let snowContainer = document.createElement('div');
    snowContainer.className = `snowContainer`;
    snowContainer.innerHTML = `<div id="snow"></div>`;
    document.body.append(snowContainer);
};