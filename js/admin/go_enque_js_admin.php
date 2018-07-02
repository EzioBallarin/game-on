<?php

function go_admin_scripts ($hook) {
    global $post;
	$user_id = get_current_user_id();

    global $version;

    /*
     * Registering Scripts For Admin Pages
     */

        /*
         * Combined scripts for every admin page. Combine all scripts unless the page needs localization.
         *
         */

            wp_register_script( 'go_admin-min', plugin_dir_url( __FILE__ ).'min/go_admin-min.js', array( 'jquery' ),$version, true);
            //wp_register_script( 'go_admin-min', plugin_dir_url( __FILE__ ).'scripts/go_every_admin_page.js', array( 'jquery' ),'v1', true);

        /*
         * Page-Specific Scripts
         */

            // Clipboard
            wp_register_script( 'go_clipboard_combined-min', plugin_dir_url( __FILE__ ).'min/go_clipboard_combined-min.js', null, $version );

            // Options Page
            wp_register_script( 'go_options_admin_js', plugin_dir_url( __FILE__ ).'min/go_options-min.js', null, $version );


			//featherlight
			//wp_register_script( 'go_featherlight_min', plugin_dir_url( __FILE__ ).'bower_components/featherlight/release/featherlight.min.js' );	
				
	/*
	 * Enqueue Scripts For Admin Pages (Exept for page specific ones below)
	 */

		// Dependencies
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-accordion' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'jquery-ui-draggable' );
		wp_enqueue_script( 'jquery-ui-droppable' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'jquery-ui-spinner' );
		wp_enqueue_script( 'jquery-ui-progressbar' );
		wp_enqueue_script( 'jquery-effects-core' );
		//wp_enqueue_script( 'go_featherlight_min' );

		//Combined Scripts
		wp_enqueue_script( 'go_admin-min' ); 
		//END Combined Scripts

		// Localization for every admin page
        wp_localize_script( 'go_admin-min', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
		wp_localize_script( 'go_admin-min', 'PluginDir', array( 'url' => plugin_dir_url( __FILE__ ) ) );
		wp_localize_script(
			'go_admin-min',
			'GO_EVERY_PAGE_DATA',
			array(
				'nonces' => array(
					'go_deactivate_plugin'         => wp_create_nonce( 'go_deactivate_plugin_' . $user_id ),
					'go_admin_bar_add'             => wp_create_nonce( 'go_admin_bar_add_' . $user_id ),
					'go_admin_bar_stats'           => wp_create_nonce( 'go_admin_bar_stats_' ),
					'go_stats_task_list'           => wp_create_nonce( 'go_stats_task_list_' ),
					'go_stats_move_stage'          => wp_create_nonce( 'go_stats_move_stage_' ),
					'go_stats_item_list'           => wp_create_nonce( 'go_stats_item_list_' ),
					'go_stats_rewards_list'        => wp_create_nonce( 'go_stats_rewards_list_' ),
					'go_stats_activity_list'       => wp_create_nonce( 'go_stats_activity_list_' ),
					'go_stats_penalties_list'      => wp_create_nonce( 'go_stats_penalties_list_' ),
					'go_stats_badges_list'         => wp_create_nonce( 'go_stats_badges_list_' ),
					'go_stats_leaderboard_choices' => wp_create_nonce( 'go_stats_leaderboard_choices_' ),
					'go_stats_leaderboard'         => wp_create_nonce( 'go_stats_leaderboard_' ),
					'go_mark_read'                 => wp_create_nonce( 'go_mark_read_' . $user_id ),
				),
			)
		);


    if ( 'toplevel_page_go_clipboard' === $hook ) {

        /*
         * Clipboard Scripts
         */

        //COMBINED
        wp_enqueue_script( 'go_clipboard_combined-min' );
        //END COMBINED

        // Localization
        wp_localize_script( 'go_clipboard_combined-min', 'Minutes_limit', array( 'limit' => get_option( 'go_minutes_color_limit' ) ) );
        wp_localize_script(
            'go_clipboard_combined-min',
            'GO_CLIPBOARD_DATA',
            array(
                'nonces' => array(
                    'go_clipboard_intable'          => wp_create_nonce( 'go_clipboard_intable_' . $user_id ),
                    'go_clipboard_intable_messages' => wp_create_nonce( 'go_clipboard_intable_messages_' . $user_id ),
                    'go_clipboard_intable_activity' => wp_create_nonce( 'go_clipboard_intable_activity_' . $user_id ),
                    'go_update_user_focuses'        => wp_create_nonce( 'go_update_user_focuses_' . $user_id ),
                    'go_clipboard_add'              => wp_create_nonce( 'go_clipboard_add_' . $user_id ),
                    'go_fix_messages'               => wp_create_nonce( 'go_fix_messages_' . $user_id ),
                ),
            )
        );
    }

    // Enqueue and Localization for options page
    if ( 'toplevel_page_go_options' === $hook ) {

        wp_enqueue_script('go_options_admin_js');
        wp_localize_script('go_options_admin_js', 'levelGrowth', get_option('options_go_loot_xp_levels_growth'));
    }
}




?>