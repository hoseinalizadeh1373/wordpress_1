<?php

use App\Database\RunMigrate;
/**
 * Plugin Name:Simotel Wordpress
 * Description: a plugin for wordpress work with simotel
 * Version :1.0
 * Author: Hosein
 * Author URI:hosein.ir
 */

 if(!defined('ABSPATH'))exit;

 require __DIR__.'/vendor/autoload.php';

 $db = new RunMigrate();
 $db->createTable('CreateTablePhones');
 $db->createTable('CreateTableEvents');
 $db->createTable('CreateTableConfig');

function simotelMainMenu(){
    add_menu_page( 'Simotel Wodpress', 'مدیریت سیموتل ', 'manage_options', 'simotel', 'configWordpress',plugins_url( '/simotelwordpress/style/img/1.png'));
    add_submenu_page( 'simotel', 'تنظیمات', 'تنظیمات', 'manage_options', 'config','configWordpress');
    add_submenu_page( 'simotel', 'لیست رویدادها', 'لیست رویدادها', 'manage_options', 'eventslist','eventsList');
    add_submenu_page( 'simotel', 'لیست شماره ها', 'لیست شماره ها', 'manage_options', 'phonelist','phoneList');

}

add_action( 'admin_menu','simotelMainMenu');

function configWordpress(){
    include 'config.php';
}
function eventsList(){
    include 'eventsList.php';
}
function phoneList(){
    include 'phoneList.php';
}


require_once 'Assets/Asset.php';

add_action( 'wp_body_open','btnShow' );
    include 'View/PusherScript.php';

    add_action( 'rest_api_init','apiRoutes' );
    function apiRoutes(){
        include 'Routes/api.php';
    }
    function register_elmentor_widget( $widgets_manager ) {

        require_once( __DIR__ . '/ElementorWidget.php' );
    
        $widgets_manager->register( new \ElementorWidget() );
    
    }
    add_action( 'elementor/widgets/register', 'register_elmentor_widget' );

