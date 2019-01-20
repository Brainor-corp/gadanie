<?php

$breadcrumbs_display = root_get_option( 'breadcrumbs_display' );
if ( 'yes' == $breadcrumbs_display ) :

    $breadcrumbs_service = 'self';

    if ( function_exists('yoast_breadcrumb') ) {
        $wpseo_internallinks             = get_option( 'wpseo_internallinks' );
        if ( $wpseo_internallinks['breadcrumbs-enable'] === true ) $breadcrumbs_service = 'yoast';
    }

    if ( $breadcrumbs_service == 'yoast' ) {
        yoast_breadcrumb('<div class="breadcrumb" id="breadcrumbs">','</div>');
    } else {
        echo wpshop_breadcrumbs();
    }

endif;