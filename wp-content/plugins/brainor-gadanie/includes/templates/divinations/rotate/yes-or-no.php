<script>
    if (!document.getElementById('divination-rotate-ball-of-destiny-css')) {
        let style = document.createElement('link');
        style.setAttribute('id', 'divination-rotate-ball-of-destiny-css');
        style.setAttribute('rel', 'stylesheet');
        style.setAttribute('type', 'text/css');
        style.setAttribute('href', '/wp-content/plugins/brainor-gadanie/assets/css/divination-rotate-ball-of-destiny.css');

        document.getElementsByTagName('head')[0].appendChild(style);
    }

    if (!document.getElementById('divination-rotate-js')) {
        let script = document.createElement('script');
        script.src = '/wp-content/plugins/brainor-gadanie/assets/js/divination-rotate.js';
        script.id = 'divination-rotate-js';
        script.type = 'text/javascript';
        document.getElementsByTagName('head')[0].appendChild(script);
    }
</script>

<!--<script type="text/javascript" src="/wp-content/plugins/brainor-gadanie/assets/js/divination-rotate-destiny.js"></script>-->
<link rel="stylesheet" href="/wp-content/plugins/brainor-gadanie/assets/css/divination-yes-or-no.css">

<div class="divination-rotate rotate-yes-or-no" id="<?php echo uniqid() ?>" data-step="180" data-items="2">
    <div class="br-rotate-block">
        <table>
            <tr>
                <td class="br-rt-yn-answer">
                    <span>Да</span>
                </td>
                <td>
                    <div class="br-rotate-pointer" data-current-rotate="0">
                        <img src="/wp-content/plugins/brainor-gadanie/assets/imgs/rotate/arrow-destiny-right.png" alt="">
                    </div>
                </td>
                <td class="br-rt-yn-answer">
                    <span>Нет</span>
                </td>
            </tr>
        </table>
    </div>
</div>