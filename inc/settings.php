<?php

if(!function_exists('btim_settings_page_html'))
{
    function btim_settings_page_html() {
        //Check if current user have admin access.
        if(!is_admin()) {
            return;
        }
        ?>
            <div class="wrap">
                <h1 style="padding:10px; background:#333;color:#fff"> <?= esc_html(get_admin_page_title()); ?></h1>
                <form action="options.php" method="post">
                    <?php
                        // output security fields for the registered setting "wpac-settings"
                        settings_fields( 'bt-iframe-manager' );

                        // output setting sections and their fields
                        // (sections are registered for "wpac-settings", each field is registered to a specific section)
                        do_settings_sections( 'bt-iframe-manager' );

                        // output save settings button
                        submit_button( 'Save Changes' );
                    ?>
                </form>
            </div>
        <?php

    }

}
//function to register plugin menu page
if( !function_exists('btim_register_menu_page')) //check if function name is available
{
    function btim_register_menu_page() {
        add_menu_page( 'BT Iframe Manager', 'BT Iframe', 'manage_options', 'bt-iframe-manager', 'btim_settings_page_html', 'dashicons-games', 30);
    }

    add_action( 'admin_menu','btim_register_menu_page');
}


//function for plugin settings
if( !function_exists('btim_plugin_settings')) //check if function name is available
{
    function btim_plugin_settings() {
        register_setting('bt-iframe-manager', 'btim_first_iframe_source');
        register_setting('bt-iframe-manager', 'btim_second_iframe_source');
        register_setting('bt-iframe-manager', 'btim_third_iframe_source');


        add_settings_section( 'btim_iframe_settings_section_des', 'Usage', 'btim_plugin_settings_section_des_cb', 'bt-iframe-manager');
        add_settings_section( 'btim_iframe_settings_section', 'Configuration', 'btim_plugin_settings_section_cb', 'bt-iframe-manager');


        add_settings_field( 'btim_first_iframe_source', 'First Iframe Source', 'btim_first_iframe_source_cb', 'bt-iframe-manager', 'btim_iframe_settings_section');
        add_settings_field( 'btim_second_iframe_source', 'Second Iframe Source', 'btim_second_iframe_source_cb', 'bt-iframe-manager', 'btim_iframe_settings_section');
        add_settings_field( 'btim_third_iframe_source', 'Third Iframe Source', 'btim_third_iframe_source_cb', 'bt-iframe-manager', 'btim_iframe_settings_section');

    }
    add_action( 'admin_init','btim_plugin_settings');

}





//callback functions

function btim_plugin_settings_section_cb()
{
    echo '<h5><b>Iframe Source Settings</b></h5>';
}

function btim_plugin_settings_section_des_cb()
{
    echo '<h5> <b>Short Codes</b> </h5> <p> 1) First iframe Shortcode -------><b>[show-bt-iframe1]</b></p>  <p> 2) Second iframe Shortcode -------> <b>[show-bt-iframe2]</b></p> <p> 3) Third iframe Shortcode -------> <b>[show-bt-iframe3]</b></p>';
}

function btim_first_iframe_source_cb()
{
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('btim_first_iframe_source');
    // output the field
    ?>
    <input type="text" style="width: 100% !important;" name="btim_first_iframe_source" value= "<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" />
    <?php
}


function btim_second_iframe_source_cb()
{
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('btim_second_iframe_source');
    // output the field
    ?>
    <input type="text" style="width: 100% !important;" name="btim_second_iframe_source" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" />
    <?php
}

function btim_third_iframe_source_cb()
{
    // get the value of the setting we've registered with register_setting()
    $setting = get_option('btim_third_iframe_source');
    // output the field
    ?>
    <input type="text" style="width: 100% !important;" name="btim_third_iframe_source" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>" />
    <?php
}