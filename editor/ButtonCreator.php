<?php


class ButtonCreator
{

    /**
     * Run the button creator
     *
     */
    public function run()
    {
        add_action('init', [$this, 'custom_mce_button']);
        add_action('admin_enqueue_scripts', [$this, 'custom_css_mce_button']);
    }

    /**
     * Enqueue the CSS file
     *
     */
    public function custom_css_mce_button() {
        wp_enqueue_style('shortcodes-icon', plugins_url(
            'css/editor.css', __FILE__));
    }

    /**
     * Callback function
     *
     * @return null
     */
    public function custom_mce_button()
    {
        // User can edit post
        if ( !current_user_can( 'edit_posts' ) || !current_user_can( 'edit_pages' ) ) {
            return;
        }
        // is Editor enabled
        if ( 'true' == get_user_option( 'rich_editing' ) ) {
           add_filter( 'mce_external_plugins', [$this, 'custom_tinymce_plugin'], 99999999 );
           add_filter( 'mce_buttons', [$this, 'register_mce_button'], 99999999 );
        }
    }

    /**
     * Enqueue JS file
     *
     * @param $plugin_array
     * @return mixed
     */
    public function custom_tinymce_plugin($plugin_array)
    {
        $plugin_array['custom_mce_button'] = plugins_url( 'wcs_plugin.js' , __FILE__ );
        return $plugin_array;
    }

    /**
     * Register new button
     *
     * @param $buttons
     * @return mixed
     */
    public function register_mce_button($buttons)
    {
        array_push( $buttons, 'custom_mce_button' );
        return $buttons;
    }
}