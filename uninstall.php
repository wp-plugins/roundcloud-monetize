<?php


function rc_monetize_delete_plugin() {
	global $wpdb;

	$table_name = $wpdb->prefix.'rc_monetize_rotators';

	$wpdb->query( "DROP TABLE IF EXISTS $table_name" );
}

rc_monetize_delete_plugin();


?>