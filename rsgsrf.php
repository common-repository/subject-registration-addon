<?php
/*
Plugin Name: Subject Registration Addon
Plugin URI: https://wordpress.org/plugins/subject-registration-addon
Description: Display a table of subject with prices for your gravity form.
Version: 0.1
Author: Ryner S. Galaus
Author URI: https://profiles.wordpress.org/ryner1
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Copyright: Ryner S. Galaus
Text Domain: rsgsrf
Domain Path: /lang
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if( ! class_exists('RSGSRF') ) :

	class RSGSRF{

		function __construct() { /* Do nothing here */ }

	    function rsgsrf_initialize(){
	    	if(!defined('rsgsrf_link')){
				define('rsgsrf_link',plugin_dir_url(__FILE__));
				define('rsgsrf_admin',rsgsrf_link.'rsgsrf-admin/');
				define('rsgsrf_admin_img',rsgsrf_admin.'images/');

				define('rsgsrf_lib',rsgsrf_link.'lib/');

			}
	        if( is_admin() ) {
	        	add_action('init', array($this, 'initialize_post'), 4);
	        	add_action('admin_menu', array($this, 'initialize_table_page'), 5);
	            add_action('admin_menu', array($this, 'initialize_tutoring_type_page'), 5);
	            add_action('admin_menu', array($this, 'initialize_school_level_page'), 5);
	            add_action('admin_menu', array($this, 'initialize_help_page'), 5);
	            add_action( 'admin_enqueue_scripts', array($this,'initialize_admin_script_styles') );
	        }
	        add_action( 'wp_enqueue_scripts', array($this,'initialize_client_script_styles') );
	    }

	    // REGISTER TABLE POST
	    function initialize_post(){
	    	register_post_type('rsgsrf',
	           array(
	            'hierarchical' => true,
	            'labels'      => array(
	               'name'          => __('Subjects'),
	               'singular_name' => __('Subjects'),
	           ),
	            'public'      => true,
	            'has_archive' => true,
	        ));

	        register_post_type('rsgsrf_post_tables',
	           array(
	            'hierarchical' => true,
	            'labels'      => array(
	               'name'          => __('Tables'),
	               'singular_name' => __('Tables'),
	           ), 'public'      => false, 'has_archive' => true
	        ));

	        register_post_type('rsgsrf_post_type',
	           array(
	            'hierarchical' => true,
	            'labels'      => array(
	               'name'          => __('Tutoring Type'),
	               'singular_name' => __('Tutoring Type'),
	           ), 'public'      => false, 'has_archive' => true
	        ));

	        register_post_type('rsgsrf_post_level',
	           array(
	            'hierarchical' => true,
	            'labels'      => array(
	               'name'          => __('School Level'),
	               'singular_name' => __('School Level'),
	           ), 'public'      => false, 'has_archive' => true
	        ));

	    }

	    // ADD SUBMENU FOR TABLE
	    function initialize_table_page(){
	        add_submenu_page( 
	            'edit.php?post_type=rsgsrf', 
	            'Tables', 'Tables', 'manage_options',
	            'rsgsrf_tables', 'rsgsrf_tables' );
	    }

	    // ADD SUBMENU FOR TUTORING TYPE
	    function initialize_tutoring_type_page(){
	        add_submenu_page( 
	            'edit.php?post_type=rsgsrf', 
	            'Tutoring Types', 'Tutoring Types', 'manage_options',
	            'rsgsrf_tutoring_type', 'rsgsrf_tutoring_type' );
	    }

	    // ADD SUBMENU FOR SCHOOL LEVELS
	    function initialize_school_level_page(){
	        add_submenu_page( 
	            'edit.php?post_type=rsgsrf', 
	            'School Levels', 'School Levels', 'manage_options',
	            'rsgsrf_school_level', 'rsgsrf_school_level' );
	    }

	    // ADD SUBMENU FOR HELP PAGE
	    function initialize_help_page(){
	        add_submenu_page( 
	            'edit.php?post_type=rsgsrf', 
	            'Help',
	            'Help',
	            'manage_options',
	            'rsgsrf_help_page', 
	            'rsgsrf_help_page' );
	    }

	    // ADMIN DAHSBOARD SCRIPTS
	    function initialize_admin_script_styles(){
			// FONT AWESOME
			if( (! wp_style_is('font_awesome', 'registered ') ) || (! wp_style_is('font_awesome', 'enqueued ') ) ){
			    wp_register_style( 'font_awesome', 'https://use.fontawesome.com/releases/v5.5.0/css/all.css', null, 1.0, 'screen' );
			    wp_enqueue_style( 'font_awesome' );
			}
			
	    	// ADMIN
		    wp_register_style( 'rsgsrf_admin_styles', rsgsrf_link.'rsgsrf-admin/assets/rsg_admin_styles.css', null, 1.0, 'screen' );
		    wp_enqueue_style( 'rsgsrf_admin_styles' );

		    wp_register_script( 'rsgsrf_admin_scripts', rsgsrf_link.'rsgsrf-admin/assets/rsg_admin_scripts.js', array( 'jquery' ), 1.0, true );
		    wp_enqueue_script( 'rsgsrf_admin_scripts' );
		    wp_localize_script( 'rsgsrf_admin_scripts', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

		    // EXTEND CLIENT
		    wp_register_style( 'rsgsrf_admin_extend_client_styles', rsgsrf_link.'rsgsrf-client/assets/client_styles.css', null, 1.0, 'screen' );
		    wp_enqueue_style( 'rsgsrf_admin_extend_client_styles' );

		    wp_register_script( 'rsgsrf_admin_extend_client_scripts', rsgsrf_link.'rsgsrf-client/assets/client_scripts.js', array( 'jquery' ), 1.0, true );
		    wp_enqueue_script( 'rsgsrf_admin_extend_client_scripts' );
		    wp_localize_script( 'rsgsrf_admin_extend_client_scripts', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
		}
		// CLIENT SCRIPTS
	    function initialize_client_script_styles(){
			// FONT AWESOME
			if( (! wp_style_is('font_awesome', 'registered ') ) || (! wp_style_is('font_awesome', 'enqueued ') ) ){

			    wp_register_style( 'font_awesome', 'https://use.fontawesome.com/releases/v5.5.0/css/all.css', null, 1.0, 'screen' );
			    wp_enqueue_style( 'font_awesome' );

			}

		    // CLIENT
		    wp_register_style( 'rsgsrf_client_styles', rsgsrf_link.'rsgsrf-client/assets/client_styles.css', null, 1.0, 'screen' );
		    wp_enqueue_style( 'rsgsrf_client_styles' );

		    wp_register_script( 'rsgsrf_client_scripts', rsgsrf_link.'rsgsrf-client/assets/client_scripts.js', array( 'jquery' ), 1.0, true );
		    wp_enqueue_script( 'rsgsrf_client_scripts' );
		    wp_localize_script( 'rsgsrf_client_scripts', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
		}
	    
	}
	if(!defined('rsg_admin_f')){
		define('rsg_admin_f','rsgsrf-admin/functions/');		
	}
	if(!defined('rsg_global_f')){
		define('rsg_global_f','rsgsrf-global/');		
	}
	if(!defined('rsg_client_f')){
		define('rsg_client_f','rsgsrf-client/functions/');		
	}

	require(rsg_admin_f.'rsgsrf-help.php');
	require(rsg_admin_f.'rsgsrf-school_level.php');
	require(rsg_admin_f.'rsgsrf-tutoring_type.php');
	require(rsg_admin_f.'rsgsrf-tables_page.php');
	require(rsg_admin_f.'rsgsrf-single_post.php');
	require(rsg_global_f.'rsgsrf-functions.php');
	require(rsg_client_f.'rsgsrf-form_modal.php');
	require(rsg_client_f.'rsgsrf-subjects_table.php');
	

	function rsgsrf_start(){
	    $rsgsrf = new RSGSRF();
	    $rsgsrf->rsgsrf_initialize();

	    return $rsgsrf;
	}

	rsgsrf_start();

endif;
