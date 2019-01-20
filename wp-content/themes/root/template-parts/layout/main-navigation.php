<?php
/**
 * Check menu exist, if no - add separator
 */
if ( has_nav_menu( 'header_menu' ) ) { ?>

    <?php do_action( 'root_before_main_navigation' ); ?>

    <nav id="site-navigation" class="main-navigation <?php root_navigation_main_classes() ?>">
        <div class="main-navigation-inner <?php root_navigation_main_inner_classes() ?>">
            <?php wp_nav_menu( array('theme_location' => 'header_menu', 'menu_id' => 'header_menu') ) ?>
        </div><!--.main-navigation-inner-->
    </nav><!-- #site-navigation -->

    <?php do_action( 'root_after_main_navigation' ); ?>

<?php } else { ?>

    <nav id="site-navigation" class="main-navigation" style="display: none;"><ul id="header_menu"></ul></nav>
    <div class="container header-separator"></div>

<?php } ?>