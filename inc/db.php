<?php

function btim_iframe_source_table()
{
    global $wpdb;

    $table_name = $wpdb->prefix . "btim_iframe_system";
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
    firstsource varchar(255),
    secondsource varchar(255),
    thirdsource varchar(255),
    PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

register_activation_hook( __FILE__, 'btim_iframe_source_table' );