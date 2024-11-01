<?php
/**
 * Plugin Name: Who Can See
 * Plugin URI: https://github.com/akiyamaSM/who-can-see
 * Description: This plugin controls the parts that can be seen.
 * Version: 1.0.0
 * Author: El Houssain Inani
 * Author URI: https://github.com/akiyamaSM
 * License: GPL2
 */

if ( ! defined( 'WPINC' ) ) {
    die;
}

require_once 'RoleManager.php';
require_once 'editor/ButtonCreator.php';

(new ButtonCreator())->run();

add_shortcode('whocansee', function ($attributes, $content )
{
    $filter = RoleManager::getOperation($attributes);
    if( is_null($filter)){
        return $content;
    }
    return $filter->apply($content);
});