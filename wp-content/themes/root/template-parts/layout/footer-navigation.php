<?php if ( has_nav_menu( 'footer_menu' ) ) {  ?>
    <div class="footer-navigation <?php root_navigation_footer_classes() ?>">
        <div class="main-navigation-inner <?php root_navigation_footer_inner_classes() ?>">
            <?php wp_nav_menu(array('theme_location' => 'footer_menu', 'menu_id' => 'footer_menu')); ?>
        </div>
    </div>
<?php } ?>