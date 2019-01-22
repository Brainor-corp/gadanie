<?php

require_once( '../../../../../wp-load.php' );

global $wpdb;

$divinationElementsTable = $wpdb->get_blog_prefix().'br_divination_elements';
$sql = "SELECT id,name from `$divinationElementsTable`";
$divinationElements = $wpdb->get_results( $sql , ARRAY_A );

wp_send_json($divinationElements);