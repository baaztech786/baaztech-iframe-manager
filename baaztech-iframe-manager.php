<?php
/**
 * Plugin Name:       Baaztech Iframe Manager
 * Plugin URI:        https://github.com/baaztech786/baaztech-iframe-manager
 * Description:       This is a custom plugin for management of source of iframes.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Baaztech
 * Author URI:        https://github.com/baaztech786
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://github.com/baaztech786/baaztech-iframe-manager
 * Text Domain:       bt-iframe-manager
 * Domain Path:       /languages
 */

//if this file is called directly , abort
if(!defined('WPINC'))
{
    die;
}

/*
***************************************************************************
**************************** CONSTANTS **************************
***************************************************************************
*/

//plugin version constant
if(!defined('BTIM_PLUGIN_VERSION'))
{
    define('BTIM_PLUGIN_VERSION', '1.0.0');
}

//plugin directory constant
if(!defined('BTIM_PLUGIN_DIR'))
{
    define('BTIM_PLUGIN_DIR', plugin_dir_url( __FILE__ ));
}



/*
***************************************************************************
**************************** Hooks **************************
***************************************************************************
*/


// function for enqueuing plugin scripts
if( !function_exists('btim_plugin_scripts')) //check if function name is available
{
    function btim_plugin_scripts() {
        wp_enqueue_style( "btim-css", BTIM_PLUGIN_DIR. 'assets/css/main.css');
        wp_enqueue_script( "btim-js", BTIM_PLUGIN_DIR. 'assets/js/main.js' ,'jQuery', '1.0.0',  true);
    }
 add_action( 'wp_enqueue_scripts', 'btim_plugin_scripts');
}


// Settings Menu & page
require plugin_dir_path( __FILE__ ) . 'inc/settings.php';


// db file
require plugin_dir_path( __FILE__ ) . 'inc/db.php';

//create source url using filters


function btim_third_iframe_source_url()
{
    $content = '';

    //get wp options
    $c = get_option( 'btim_third_iframe_source' );

    //add all source url variables
    $third_source = '<iframe class="beginbridge" src="'.$c.'" sandbox="allow-forms allow-scripts allow-popups allow-presentation allow-same-origin allow-modals" allow="microphone; camera; fullscreen; autoplay"></iframe><div class="tve_iframe_cover"></div>';

    $content .= $third_source;

    return $content;
}

// add_filter( 'the_content', 'btim_iframe_source_url');
add_shortcode( 'show-bt-iframe3', 'btim_third_iframe_source_url' );

function btim_second_iframe_source_url()
{
    $content = '';

    //get wp options
    $b = get_option( 'btim_second_iframe_source' );

    //add all source url variables
    $second_source = '<iframe class="beginbridge" src="'.$b.'" sandbox="allow-forms allow-scripts allow-popups allow-presentation allow-same-origin allow-modals" allow="microphone; camera; fullscreen; autoplay"></iframe><div class="tve_iframe_cover"></div>';
    $content .= $second_source;

    return $content;
}

// add_filter( 'the_content', 'btim_iframe_source_url');
add_shortcode( 'show-bt-iframe2', 'btim_second_iframe_source_url' );


function btim_first_iframe_source_url()
{
    $content = '';
    //get wp options
    $a = get_option( 'btim_first_iframe_source' );

    //add all source url variables
    $first_source = '<iframe class="beginbridge" src="'.$a.'" sandbox="allow-forms allow-scripts allow-popups allow-presentation allow-same-origin allow-modals" allow="microphone; camera; fullscreen; autoplay"></iframe><div class="tve_iframe_cover"></div>';

    $content .= $first_source;

    return $content;
}

// add_filter( 'the_content', 'btim_iframe_source_url');
add_shortcode( 'show-bt-iframe1', 'btim_first_iframe_source_url' );