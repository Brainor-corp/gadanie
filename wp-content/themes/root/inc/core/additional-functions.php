<?php

function clean_style_tag($src) {
    return str_replace("type='text/css'", '', $src);
}
add_filter('style_loader_tag', 'clean_style_tag');

function clean_script_tag($src) {
    return str_replace("type='text/javascript'", '', $src);
}
add_filter('script_loader_tag', 'clean_script_tag');
