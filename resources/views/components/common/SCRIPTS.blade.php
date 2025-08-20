<!-- bootstrap JS -->
<script src="{{ asset("/vendors/bootstrap/bootstrap.bundle.min.js")  }}"></script>
<script src="{{ asset("/vendors/bootstrap/bootstrap.min.js")  }}"></script>

<!--fancybox-->
<script src='{{ asset("/vendors/fancybox/jquery.fancybox.min.js")  }}'></script>

<!--<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>-->

<!-- Plugins JS -->
<script src="{{ asset("/assets/js-plugins/gs.plugins.js")  }}"></script>
<!-- Gravity Core JS -->
<script src="{{ asset("/assets/js-plugins/gs.core.js")  }}"></script>
<!-- Gravity Components JS -->
<script src="{{ asset("/assets/js-plugins/gs.components.js")  }}"></script>
<!-- Gravity Helpers JS -->
<script src="{{ asset("/assets/js-plugins/gs.helpers.js")  }}"></script>
<!-- Gravity Init JS -->
<script src="{{ asset("/assets/js-plugins/gs.init.js")  }}"></script>

<!--jquery-ui-->

<script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>


<!--script>
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
</script-->
