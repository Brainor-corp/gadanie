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
                case "personal-card-of-the-year":
                    require_once(BR_DIVINATION_DIR.'includes/templates/divinations/taro/personal-card-of-the-year.php');
                    break;
                case "future-husband":
                    require_once(BR_DIVINATION_DIR.'includes/templates/divinations/taro/future-husband.php');
                    break;
                case "zhelanie-i-mechta":
                    require_once(BR_DIVINATION_DIR.'includes/templates/divinations/taro/zhelanie-i-mechta.php');
                    break;
                case "na-dengi":
                    require_once(BR_DIVINATION_DIR.'includes/templates/divinations/taro/na-dengi.php');
                    break;
                case "pregrady-na-puti-lyubvi":
                    require_once(BR_DIVINATION_DIR.'includes/templates/divinations/taro/pregrady-na-puti-lyubvi.php');
                    break;
                case "v-poiskax-lyubvi":
                    require_once(BR_DIVINATION_DIR.'includes/templates/divinations/taro/v-poiskax-lyubvi.php');
                    break;
                case "na-budushhego-muzha":
                    require_once(BR_DIVINATION_DIR.'includes/templates/divinations/taro/na-budushhego-muzha.php');
                    break;
                case "na-otnoshenie-k-lyubimogo-muzhchiny":
                    require_once(BR_DIVINATION_DIR.'includes/templates/divinations/taro/na-otnoshenie-k-lyubimogo-muzhchiny.php');
                    break;
                case "goroskop":
                    require_once(BR_DIVINATION_DIR.'includes/templates/divinations/taro/goroskop.php');
                    break;
                case "lyubit-li-on-menya":
                    require_once(BR_DIVINATION_DIR.'includes/templates/divinations/taro/lyubit-li-on-menya.php');
                    break;
                case "lyubovnyj-treugolnik":
                    require_once(BR_DIVINATION_DIR.'includes/templates/divinations/taro/lyubovnyj-treugolnik.php');
                    break;
                case "na-vernost-lyubimogo":
                    require_once(BR_DIVINATION_DIR.'includes/templates/divinations/taro/na-vernost-lyubimogo.php');
                    break;
                case "podxodite-li-vy-drug-drugu":
                    require_once(BR_DIVINATION_DIR.'includes/templates/divinations/taro/podxodite-li-vy-drug-drugu.php');
                    break;
                case "na-situaciyu":
                    require_once(BR_DIVINATION_DIR.'includes/templates/divinations/taro/na-situaciyu.php');
                    break;
                case "na-zavtrashnij-den":
                    require_once(BR_DIVINATION_DIR.'includes/templates/divinations/taro/na-zavtrashnij-den.php');
                    break;
                default: echo '[divination_error: неизвестный слаг]';
            }
        }else{
            echo '[divination_error: не задан слаг]';
        }

    }

    return ob_get_clean();

}

add_shortcode ( 'br_divination', 'br_divination_output' );

//END----Divination templates include