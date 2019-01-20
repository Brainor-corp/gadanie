<?php
/*
Пакеты
*/

?>
<div class="wrap">
    <h2><?php echo get_admin_page_title() ?></h2>
        <?php
            global $wpdb;
            $table = $wpdb->get_blog_prefix().'bmcalc_packages';
            $sql = "SELECT * from `$table` ORDER BY `priority` ";
            $result = $wpdb->get_results( $sql , ARRAY_A );
        ?>
        <ul class="all-packages-wrapper sortable">
            <?php packagesOutput($result); ?>
        </ul>
        <button id="add-package-btn" class="btn btn-primary">Добавить пакет</button>
    <div id="ajax-loading-gif"
         style="display: none;position: fixed;left: 0;right: 0;top: 0;bottom: 0;background: rgba(194, 202, 206, 0.48);z-index: 99999;">
        <img src="<?php echo get_template_directory_uri(); ?>/img/loading.svg" style="position: absolute;top: 40%;left: 47%">
    </div>
</div>

