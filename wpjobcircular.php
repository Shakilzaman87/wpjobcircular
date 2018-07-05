<?php
/*
Plugin Name: Wp Job Circular
Plugin URI: http://techhaat.com/plugins/wpjobcircular
Author: Tech Haat
Author URI: https://shakilzaman.com
Description: Simple way to manage company jobs and applicants.   
Version: 1.0
License: GPLv2 or later
Text Domain: wpjobcircular
*/

// Include Files
require_once dirname(__FILE__).'/lib/cmb2/init.php';
require_once dirname(__FILE__).'/lib/cmb2/functions.php';
require_once dirname(__FILE__).'/includes/submenupages.php';
require_once dirname(__FILE__).'/includes/database.php';
require_once dirname(__FILE__).'/includes/shortcodes.php';

// Enqueue Files
function jobcircular_enque_style()
{       
    wp_enqueue_style( 'bootstrap_min_css', plugins_url('assets/css/modalstyle.css',__FILE__ ));
	wp_enqueue_script( 'bootstrap_min', plugins_url('assets/js/bootstrap.min.js',__FILE__ ),array('jquery'),'',true);
}
add_action('wp_enqueue_scripts','jobcircular_enque_style');

// Register Jobs post type 
function create_job_post() {
  register_post_type( 'jobcircular',
    array(
      'labels' => array(
        'name' => __( 'Job Circular' ),
        'singular_name' => __( 'Job Circular' ),
        'add_new_item' => __( 'Add New Job' ),
        'add_new' => __( 'Add New Job' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
}

add_action( 'init', 'create_job_post' );

// Admin Menu
function jobcircular_menu()
{
	add_submenu_page( 'edit.php?post_type=jobcircular', 'Applicants', 'Applicants', 'manage_options', 'applicants', 'applicants_page');
}

add_action('admin_menu', 'jobcircular_menu');

// Remove applicant table  
register_deactivation_hook( __FILE__, 'my_plugin_remove_database' );
function my_plugin_remove_database() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'NestoNovo';
    $sql = "DROP TABLE IF EXISTS applicant";
    $wpdb->query($sql);
    delete_option("my_plugin_db_version");
}
?>