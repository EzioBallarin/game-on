<?php
/*
Plugin Name: Game-On
Plugin URI: http://maclab.guhsd.net/game-on
Description: Gamification tools for teachers.
Author: Valhalla Mac Lab
Author URI: https://github.com/TheMacLab/game-on/blob/master/README.md
Version: 4b
*/


if( ! class_exists( 'wp-featherlight' ) ) {
	include( 'includes/wp-featherlight/wp-featherlight.php' );
}

if( ! class_exists( 'FitVidsWP' ) ) {
	// FitVids Plugin is not active
	include( 'includes/fitvids-for-wordpress/fitvids-for-wordpress.php' );
}

if( ! class_exists( 'WP_Term_Order' ) ) {
	// WP Term Order Plugin is not active
	include( 'includes/wp-term-order/wp-term-order.php' );
}

foreach ( glob( plugin_dir_path( __FILE__ ) . "*.php" ) as $file ) {
    include_once $file;
}

include_once ( 'types/types.php' );


foreach ( glob( plugin_dir_path( __FILE__ ) . "types/store/*.php" ) as $file ) {
    include_once $file;
}

foreach ( glob( plugin_dir_path( __FILE__ ) . "types/tasks/*.php" ) as $file ) {
    include_once $file;
}

include( plugin_dir_path( __FILE__ ) . 'types/test/test_shortcode.php');




//if( ! class_exists( 'CMB2_Bootstrap_2253' ) ) {
	// CMB2 Plugin is not active
	//include( 'includes/cmb2/init.php' );
//}


/*
 * Plugin Activation Hooks
 */

register_activation_hook( __FILE__, 'go_table_totals' );
register_activation_hook( __FILE__, 'go_table_individual' );
register_activation_hook( __FILE__, 'go_ranks_registration' );
register_activation_hook( __FILE__, 'go_presets_registration' );
register_activation_hook( __FILE__, 'go_install_data' );
register_activation_hook( __FILE__, 'go_open_comments' );
register_activation_hook( __FILE__, 'go_tsk_actv_activate' );
register_activation_hook( __FILE__, 'go_map_activate' );
register_activation_hook( __FILE__, 'go_store_activate' );

/*
 * Init
 */


/* 
 * Registers Game On custom post types and taxonomies, then
 * updates the site's rewrite rules to mitigate cpt and 
 * permalink conflicts. flush_rewrite_rules() must always
 * be called AFTER custom post types and taxonomies are
 * registered.
 */
 //https://developer.wordpress.org/reference/functions/flush_rewrite_rules/
 
register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
register_activation_hook( __FILE__, 'go_flush_rewrites' );
 
 
/**
 * Flush rewrite rules on activation
 */
function go_flush_rewrites() {
    // call your CPT registration function here (it should also be hooked into 'init')
    go_register_task_tax_and_cpt();
    go_register_store_tax_and_cpt();
    flush_rewrite_rules();
}


//function go_register_tax_and_cpt() {
//	go_register_task_tax_and_cpt();
//	go_register_store_tax_and_cpt();
//	flush_rewrite_rules();
//}

/*
 * Admin Menu & Admin Bar
 */

// actions
add_action( 'admin_menu', 'add_game_on_options' );
add_action( 'admin_menu', 'go_clipboard' );
add_action( 'admin_menu', 'go_pod_submenu' );
add_action( 'admin_bar_init', 'go_messages_bar' );
add_action( 'admin_bar_init', 'go_admin_bar' );

/*
 * Admin & Login Page
 */

add_action( 'admin_init', 'go_tsk_actv_redirect' );
add_action( 'admin_init', 'go_add_delete_post_hook' );
add_action( 'admin_head', 'go_stats_overlay' );
add_action( 'admin_head', 'go_store_head' );
add_action( 'admin_notices', 'go_admin_head_notification' );
add_action( 'admin_enqueue_scripts', 'go_admin_scripts_and_styles' );
add_action( 'login_redirect', 'go_user_redirect', 10, 3 );

/*
 * Front-end
 */

// actions
add_action( 'wp_head', 'go_stats_overlay' );
add_action( 'wp_head', 'go_frontend_lightbox_html' );
add_action( 'wp_enqueue_scripts', 'go_scripts_and_styles' );

// filters
add_filter( 'get_comment_author', 'go_display_comment_author', 10, 3 );

/*
 * User Data
 */

add_action( 'delete_user', 'go_user_delete' );
add_action( 'user_register', 'go_user_registration' );
add_action( 'show_user_profile', 'go_extra_profile_fields' );
add_action( 'edit_user_profile', 'go_extra_profile_fields' );
add_action( 'personal_options_update', 'go_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'go_save_extra_profile_fields' );
add_action( 'wp_footer', 'go_update_totals_out_of_bounds', 21 );

/*
 * AJAX Hooks
 */

add_action( 'wp_ajax_go_deactivate_plugin', 'go_deactivate_plugin' );
add_action( 'wp_ajax_go_clone_post', 'go_clone_post' );
add_action( 'wp_ajax_go_clipboard_intable', 'go_clipboard_intable' );
add_action( 'wp_ajax_go_clipboard_intable_messages', 'go_clipboard_intable_messages' );
add_action( 'wp_ajax_go_user_option_add', 'go_user_option_add' );
add_action( 'wp_ajax_go_test_point_update', 'go_test_point_update' );
add_action( 'wp_ajax_go_unlock_stage', 'go_unlock_stage' );
add_action( 'wp_ajax_go_task_change_stage', 'go_task_change_stage' );
add_action( 'wp_ajax_go_task_abandon', 'go_task_abandon' );
add_action( 'wp_ajax_go_admin_bar_add', 'go_admin_bar_add' );
add_action( 'wp_ajax_go_admin_bar_stats', 'go_admin_bar_stats' );
add_action( 'wp_ajax_go_class_a_save', 'go_class_a_save' );
add_action( 'wp_ajax_go_class_b_save', 'go_class_b_save' );
add_action( 'wp_ajax_go_update_user_sc_data', 'go_update_user_sc_data' );
add_action( 'wp_ajax_go_focus_save', 'go_focus_save' );
add_action( 'wp_ajax_go_reset_levels', 'go_reset_levels' );
add_action( 'wp_ajax_go_save_levels', 'go_save_levels' );
add_action( 'wp_ajax_go_reset_data', 'go_reset_data' );
add_action( 'wp_ajax_go_stats_task_list', 'go_stats_task_list' );
add_action( 'wp_ajax_go_stats_move_stage', 'go_stats_move_stage' );
add_action( 'wp_ajax_go_stats_item_list', 'go_stats_item_list' );
add_action( 'wp_ajax_go_stats_rewards_list', 'go_stats_rewards_list' );
add_action( 'wp_ajax_go_stats_minutes_list', 'go_stats_minutes_list' );
add_action( 'wp_ajax_go_stats_penalties_list', 'go_stats_penalties_list' );
add_action( 'wp_ajax_go_stats_badges_list', 'go_stats_badges_list' );
add_action( 'wp_ajax_go_stats_leaderboard_choices', 'go_stats_leaderboard_choices' );
add_action( 'wp_ajax_go_stats_leaderboard', 'go_stats_leaderboard' );
add_action( 'wp_ajax_go_presets_reset', 'go_presets_reset' );
add_action( 'wp_ajax_go_presets_save', 'go_presets_save' );
add_action( 'wp_ajax_go_fix_levels', 'go_fix_levels' );
add_action( 'wp_ajax_listurl', 'listurl' );
add_action( 'wp_ajax_go_update_user_focuses', 'go_update_user_focuses' );
add_action( 'wp_ajax_go_get_all_terms', 'go_get_all_terms' );
add_action( 'wp_ajax_go_get_all_posts', 'go_get_all_posts' );
add_action( 'wp_ajax_go_update_task_order', 'go_update_task_order' );
add_action( 'wp_ajax_go_search_for_user', 'go_search_for_user' );
add_action( 'wp_ajax_go_admin_remove_notification', 'go_admin_remove_notification' );
add_action( 'wp_ajax_go_get_purchase_count', 'go_get_purchase_count' );
add_action( 'wp_ajax_nopriv_go_get_purchase_count', 'go_get_purchase_count' );
add_action( 'wp_ajax_go_buy_item', 'go_buy_item' );
add_action( 'wp_ajax_nopriv_go_buy_item', 'go_buy_item' );
add_action( 'wp_ajax_go_clipboard_add', 'go_clipboard_add' );
add_action( 'wp_ajax_go_fix_messages', 'go_fix_messages' );
add_action( 'wp_ajax_go_mark_read', 'go_mark_read' );
add_action( 'wp_ajax_go_lb_ajax', 'go_the_lb_ajax' );
add_action( 'wp_ajax_nopriv_go_lb_ajax', 'go_the_lb_ajax' );
add_action( 'wp_ajax_go_update_last_map', 'go_update_last_map' );
add_action( 'wp_ajax_check_if_top_term', 'go_check_if_top_term' );


/*
 * Miscellaneous Filters
 */

add_filter( 'cron_schedules', 'go_weekly_schedule' );
add_filter( 'attachment_fields_to_edit', 'go_badge_add_attachment', 2, 2 );

// mitigating compatibility issues with Jetpack plugin by Automatic
// (https://wordpress.org/plugins/jetpack/).
add_filter( 'jetpack_enable_open_graph', '__return_false' );




/*
 * Important Functions
 */

/**
 * Determines if a badge exists.
 *
 * @param int $id The attachment ID.
 * @return boolean True if the attachment exists, false otherwise.
 */
function go_badge_exists( $id ) {
	if ( ! is_int( $id ) || $id < 0 ) {
		return false;
	}

	// checks to see that the corresponding attachment exists
	return wp_get_attachment_image_url( $id ) ? true : false;
}

/**
 * Appends errors to the configured PHP error log.
 *
 * Use this function to easily output Game On errors.
 *
 * @since 3.0.0
 *
 * @param  string  $error The error message.
 * @param  string  $func  The name of the function which is calling go_error_log().
 * @param  string  $file  The name of the file in which go_error_log() is being called.
 * @param  boolean $trace Whether or not to output a stack trace.
 */
function go_error_log( $error = '', $func = __FUNCTION__, $file = __FILE__, $trace = false ) {
	if ( ! defined( 'WP_DEBUG' ) || ! WP_DEBUG ) {
		return;
	}

	if ( '' !== $error ) {
		$log = "Game On Error: {$error}. " .
			( ! empty( $func ) ? "from {$func}() " : '' ) .
			( ! empty( $file ) ? "in {$file}" : 'erring file not provided' );
		if ( true === $trace ) {
			$exception = new Exception;
			$log .= print_r( "\nTrace:\n" . $exception->getTraceAsString(), true );
		}
		error_log( $log );
	}
}

function go_deactivate_plugin() {
	if ( ! current_user_can( 'manage_options' ) ) {
		die( -1 );
	}
	check_ajax_referer( 'go_deactivate_plugin_' . get_current_user_id() );

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	$plugin = plugin_basename( __FILE__ );
	deactivate_plugins( $plugin );
	die();
}

function go_tsk_actv_activate() {
	add_option( 'go_tsk_actv_do_activation_redirect', true );
	update_option( 'go_display_admin_explanation', true );
}

function go_tsk_actv_redirect() {
	if ( get_option( 'go_tsk_actv_do_activation_redirect', false ) ) {
		delete_option( 'go_tsk_actv_do_activation_redirect' );
		if ( ! isset( $_GET['activate-multi'] ) ) {
			wp_redirect( 'admin.php?page=game-on-options.php&settings-updated=true' );
		}
	}
}

function go_add_delete_post_hook() {
	if ( current_user_can( 'delete_posts' ) ) {
		add_action( 'delete_post', 'go_delete_cpt_data' );
	}
}

function go_delete_cpt_data( $cpt_id ) {
	global $wpdb;
	if ( "tasks" == get_post_type( $cpt_id ) || "go_store" == get_post_type( $cpt_id ) ) {
		$cpt_to_delete = $wpdb->get_var( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}go WHERE post_id = %d", $cpt_id ) );
		if ( $cpt_to_delete ) {
			return $wpdb->query( $wpdb->prepare( "DELETE FROM {$wpdb->prefix}go WHERE post_id = %d", $cpt_id ) );
		}
	}
	return true;
}



function go_user_redirect( $redirect_to, $request, $user ) {
	$redirect_on = get_option( 'go_admin_bar_user_redirect', true );
	$redirect_url = get_option( 'go_user_redirect_location', true );
	if ( $redirect_on && isset( $user ) && ( $user instanceof WP_User ) ) {
		if ( isset( $user->roles ) && is_array( $user->roles ) ) {
			$roles = $user->roles;
			if ( is_array( $roles) ) {
				if ( in_array( 'administrator', $roles ) ) {
					return admin_url();
				} else {
					if (! empty ($redirect_url)){
						return (site_url().'/'.$redirect_url);
					}
					else{
						return site_url();
					}
				}
			} else {
				if ( $roles == 'administrator' ) {
					return admin_url();
				} else {
					if (! empty ($redirect_url)){
						return (site_url().'/'.$redirect_url);
					}
					else{
						return site_url();
					}
				}
			}
		}
	} else {
		return $redirect_to;
	}
}

function go_admin_head_notification() {
	if ( get_option( 'go_display_admin_explanation' ) && current_user_can( 'manage_options' ) ) {
		$plugin_data = get_plugin_data( __FILE__, false, false );
		$plugin_version = $plugin_data['Version'];
		$nonce = wp_create_nonce( 'go_admin_remove_notification_' . get_current_user_id() );

		echo "<div id='message' class='update-nag' style='font-size: 16px;'>This is a fresh installation of Game On (version <a href='https://github.com/TheMacLab/game-on/releases/tag/v{$plugin_version}' target='_blank'>{$plugin_version}</a>).<br/>Watch <a href='javascript:;'  onclick='go_display_help_video(&quot;http://maclab.guhsd.net/go/video/gameOn.mp4&quot;);' style='display:inline-block;'>this short video</a> for important information.<br/>Or visit the <a href='http://maclab.guhsd.net/game-on' target='_blank'>documentation page</a>.<br/>
			<div style='position: relative; left: 20px;'>
				</br>
				SEE WHAT'S NEW IN THIS VERSION: 
				<ul style='list-style:disc;'>
					<li><a href='#' onclick='go_display_help_video( \" https://www.youtube.com/embed/g_xP8BflPAs?autoplay=1&rel=0 \" ) '>Overview of What's New</a></li>
					<li><a href='#' onclick='go_display_help_video( \" https://www.youtube.com/embed/rPQiirHBjt4?autoplay=1&rel=0 \" ) ' tooltip='hi'>Maps</a></li>
					<li><a href='#' onclick='go_display_help_video( \" https://www.youtube.com/embed/m2IAYdNZoM4?autoplay=1&rel=0 \" ) ' tooltip='hi'>Auto Store Page</a></li>
					<li><a href='#' onclick='go_display_help_video( \" https://www.youtube.com/embed/6iZsyDUt98w?autoplay=1&rel=0 \" ) ' tooltip='hi'>Videos: Auto Embed, Fit, and Lightbox</a></li>
				</ul>
			</div>
			<a href='javascript:;' onclick='go_remove_admin_notification()'>Dismiss messsage</a>
		</div>
		<script>
			function go_remove_admin_notification() {
				jQuery.ajax( {
					type: 'post',
					url: MyAjax.ajaxurl,
					data: {
						_ajax_nonce: '{$nonce}',
						action: 'go_admin_remove_notification'
					},
					success: function( res ) {
						if ( 'success' === res ) {
							location.reload();
						}
					}
				} );
			}
		</script>";
	}
}

function go_admin_remove_notification() {
	if ( ! current_user_can( 'manage_options' ) ) {
		die( -1 );
	}
	check_ajax_referer( 'go_admin_remove_notification_' . get_current_user_id() );

	update_option( 'go_display_admin_explanation', false );

	die( 'success' );
}

function go_weekly_schedule( $schedules ) {
	$schedules['go_weekly'] = array(
		'interval' => 604800,
		'display' => __( 'Once Weekly' )
	);
	return $schedules;
}

function go_task_timer_headers() {
	$custom_fields = get_post_custom();
	$future_switches = ( ! empty( $custom_fields['go_mta_time_filters'][0] ) ? unserialize( $custom_fields['go_mta_time_filters'][0] ) : '' );
	if ( 'tasks' == get_post_type() && ! empty( $future_switches['future'] ) && 'on' == $future_switches['future'] ) {
		header( 'Expires: Thu, 1 Jan 1970 00:00:00 GMT' );
		header( 'Cache-Control: no-store, no-cache, must-revalidate' );
		header( 'Cache-Control: post-check=0, pre-check=0', FALSE );
		header( 'Pragma: no-cache' );	
	}
}

/**
 * Determines if the string has a boolean value of true (case is ignored).
 *
 * This exists because `boolval( 'true' )` equals the boolean value of true, as does
 * `boolval( 'false' )`. Typecasting a string as a boolean (using `(boolean) $var`) doesn't work
 * either. That achieves the same undesired effect. This function isn't insanely helpful, but it
 * does save a few lines.
 *
 * @since 3.0.0
 *
 * @param  string $str The string to check for a boolean value of true.
 * @return boolean Returns true if the string is equal to 'true', otherwise it returns false.
 */
function go_is_true_str( $str ) {
	if ( ! empty( $str ) && 'string' === gettype( $str ) && 'true' === strtolower( $str ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Determines whether or not a user is an administrator with management capabilities.
 *
 * @since 3.0.0
 *
 * @param int $user_id Optional. The user ID.
 * @return boolean True if the user has the 'administrator' role and has the 'manage_options'
 *                 capability. False otherwise.
 */
function go_user_is_admin( $user_id = null ) {
	if ( empty( $user_id ) ) {
		$user_id = get_current_user_id();
	} else {
		$user_id = (int) $user_id;
	}

	$the_user = get_user_by( 'id', $user_id );
	if ( empty( $the_user ) ) {
		return false;
	}
	$roles = $the_user->roles;
	if ( ! empty( $roles ) ) {
		$can_manage = user_can( $the_user, 'manage_options' );
		foreach ( $roles as $role ) {
			if ( 'administrator' === $role && $can_manage ) {
				return true;
			}
		}
	}

	return false;
}

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}
?>
