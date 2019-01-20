<?php

//Divination templates include

function br_divination_output ($attributes,  $content = null ) {

    ob_start();

    $params = shortcode_atts( array( // в массиве укажите значения параметров по умолчанию
        'type' => 'list',
        'slug' => null,
    ), $attributes );
    if($params['type'] == 'list'){

    }
    elseif ($params['type'] == 'single'){
        if(null !== $params['slug']){
            switch ($params['slug']) {
                case "first":
                    require_once(BR_DIVINATION_DIR.'includes/templates/divinations/first/index.php');
                    break;
            }
        }else{
            echo '[divination_error: не задан слаг]';
        }

    }

    return ob_get_clean();

}

add_shortcode ( 'br_divination', 'br_divination_output' );

//END----Divination templates include