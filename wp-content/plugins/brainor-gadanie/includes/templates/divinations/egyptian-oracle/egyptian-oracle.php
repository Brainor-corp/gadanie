<script>
    if (!document.getElementById('divination-egyptian-oracle-css')) {
        let style = document.createElement('link');
        style.setAttribute('id', 'divination-egyptian-oracle-css');
        style.setAttribute('rel', 'stylesheet');
        style.setAttribute('type', 'text/css');
        style.setAttribute('href', '/wp-content/plugins/brainor-gadanie/assets/css/divination-egyptian-oracle.css');

        document.getElementsByTagName('head')[0].appendChild(style);
    }

    if (!document.getElementById('divination-egyptian-oracle-js')) {
        let script = document.createElement('script');
        script.src = '/wp-content/plugins/brainor-gadanie/assets/js/divination-egyptian-oracle.js';
        script.id = 'divination-egyptian-oracle-js';
        script.type = 'text/javascript';
        document.getElementsByTagName('head')[0].appendChild(script);
    }
</script>

<div class="divination-egyptian-oracle" id="<?php echo uniqid() ?>">
    <table>
        <?php for($i = 0; $i < 3; $i++): ?>
            <tr>
                <?php for($k = 0; $k < (9 - (5 + ($i * 2))) / 2; $k++): ?>
                    <td></td>
                <?php endfor ?>
                <?php for($j = 0; $j < 5 + ($i * 2); $j++): ?>
                    <td>
                        <?php
                            $imgNumber = $j % 2 == 0 ? 1 : 2;
                        ?>
                        <img class="egypt-triangle" src="/wp-content/plugins/brainor-gadanie/assets/imgs/egypt/egipt<?php echo $imgNumber ?>.png" alt="">
                    </td>
                <?php endfor ?>
                <?php for($k = 0; $k < (9 - (5 + ($i * 2))) / 2; $k++): ?>
                    <td></td>
                <?php endfor ?>
            </tr>
        <?php endfor ?>
    </table>
</div>