<?php

function go_list_user_URL() {
	$class_names = get_option( 'go_class_a' );
	$nonce = wp_create_nonce( 'go_list_user_url_' . get_current_user_id() );
?>
	<select id="go_period_list_user_url">
		<option value="select_option">Select an option</option>
		<?php
			foreach ( $class_names as $class_name ) {
				echo "<option value='{$class_name}'>{$class_name}</option>";
			}
		?>
	</select>
	<script type="text/javascript"> 
	var period = jQuery( '#go_period_list_user_url' );
	period.change( function() {
		var period_val = period.val();
		var go_ajaxurl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
		jQuery.ajax({
			url: go_ajaxurl,
			type: "POST",
			data:{
				_ajax_nonce: '<?php echo $nonce; ?>',
				action: 'listurl',
				class_a_choice: period_val
			},
			success: function( res ) {
				if ( -1 !== res ) {
					jQuery( '#go_list_user_url' ).append( res );
					period.change( function() {
						jQuery( '#go_list_user_url' ).html( '' );
					});
				}
			}
		});
	});
	</script>
	<div id="go_list_user_url" style="margin-top:10px; width:100%;"></div>
	<?php
}

function listurl() {
	global $wpdb;
	if ( isset( $_POST['class_a_choice'] ) ) {
		check_ajax_referer( 'go_list_user_url_' . get_current_user_id() );

		$class_a_choice = sanitize_text_field( $_POST['class_a_choice'] );
		$table_name_go_totals = $wpdb->prefix.'go_totals';
		$go_user_id_array = $wpdb->get_results( "SELECT uid FROM {$table_name_go_totals}" );
		foreach ( $go_user_id_array as $user_id_obj ) {
			$user_id = $user_id_obj->uid;
			$user_class = get_user_meta( $user_id, 'go_classifications', true );
			if ( ! empty( $user_class ) ) {
				$class = array_keys( $user_class );
				$user_in_class = in_array( $class_a_choice, $class );
				if ( $user_in_class ) {
					$user = get_user_by( 'id', $user_id );
					$user_url = $user->user_url;
					if ( ! empty( $user->user_url ) ) {
						$user_username = $user->user_name;
						$user_complete_url = "<a class='go_user_url' href='{$user_url}' target='_blank' >{$user_username}</a><br/>";
						echo $user_complete_url;
					}
				}
			}
		}
	}
	die( -1 );
}
add_shortcode( 'go_list_URL', 'go_list_user_URL' );

function go_video_link( $atts, $video_url ) {
	$atts = shortcode_atts( 
		array(
			'video_url' => '',
			'video_title' => ''
		), 
		$atts
	);
	$video_url = ( ! empty ( $video_url ) ? $video_url : $atts['video_url'] );
	$video_title = $atts['video_title'];
	if ( $video_url ) {

		if ( $video_title ) {
			//return "<a href='#'  data-featherlight='<video controls><source src=\"".$video_url."\"></video>'>{$video_title}</a>";
            //return "<a class='featherlight_wrapper_vid_link' href='{$video_url}' data-featherlight='iframe'>{$video_title}</a>";
            return "<a href='#' class='featherlight_wrapper_vid_shortcode' data-featherlight='<div id=\"go_video_container\" style=\"height: 90vh; overflow: hidden; text-align: center;\"> <video controls autoplay style=\"height: 100%; max-width: 100%;\"><source src=\"{$video_url}\" type=\"video/mp4\">Your browser does not support the video tag.</video></div>'  data-featherlight-close-on-esc='true' data-featherlight-variant='fit_and_box native2' >{$video_title}</a> ";
		} else {
            return "<a href='#' class='featherlight_wrapper_vid_shortcode' data-featherlight='<div id=\"go_video_container\" style=\"height: 90vh; overflow: hidden; text-align: center;\"> <video controls autoplay style=\"height: 100%; max-width: 100%;\"><source src=\"{$video_url}\" type=\"video/mp4\">Your browser does not support the video tag.</video></div>'  data-featherlight-close-on-esc='true' data-featherlight-variant='fit_and_box native2' >Video</a> ";

        }

	}
}

add_shortcode( 'go_display_video', 'go_video_link' );
add_shortcode( 'go_video_link', 'go_video_link' );

function go_display_video( $atts, $video_url ) {
    $atts = shortcode_atts(
        array(
            'video_url' => '',
            'video_title' => '',
            'height' => '',
            'width' => '',
        ),
        $atts
    );
    $video_url = ( ! empty ( $video_url ) ? $video_url : $atts['video_url'] );
    $video_title = $atts['video_title'];
    if ( $video_url ) {
        if ( $atts['height'] && $atts['width'] ) {
            ?>
            <script type="text/javascript">
                jQuery( '.light' ).css({'height': '<?php echo $atts['height']; ?>px', 'width': '<?php echo $atts['width']; ?>px'});
            </script>
            <?php
        }
        if ( $atts['height'] ) {
            ?>
            <script type="text/javascript">
                jQuery( '.light' ).css({'height': '<?php echo $atts['height']; ?>px', 'margin-top': '-<?php echo $atts['height']/2; ?>px'});
            </script>
            <?php
        }
        if ( $atts['width'] ) {
            ?>
            <script type="text/javascript">
                jQuery( '.light' ).css({'width': '<?php echo $atts['width']; ?>px', 'margin-left': '-<?php echo $atts['width']/2; ?>px'});
            </script>
            <?php
        }
        if ( $video_title ) {
            return "<a href='javascript:;' onclick='go_display_help_video( ".esc_attr( '\''.$video_url.'\'' )." );'>{$video_title}</a>";
        } else {
            return "<a href='javascript:;' onclick='go_display_help_video( ".esc_attr( '\''.$video_url.'\'' )." );'>video</a>";
        }
    }
}
//add_shortcode( 'go_display_video', 'go_display_video' );

function go_video($atts){
    extract(shortcode_atts(array(
        'video_url' => ''
    ), $atts));


    $video_url = $atts['video_url'];;

    $lightbox = "[video mp4=" . $video_url . "][/video]";
    //<video class='wp-video-shortcode' preload='metadata' src='{$video_url }?_=1' style='width: 200px;'><source src='{$video_url }?_=1'><a href='{$video_url }'>{$video_url }</a></video>

    return do_shortcode($lightbox);

}
add_shortcode( 'go_video','go_video' );

function go_lightbox_url($atts){
    extract(shortcode_atts(array(
        'link_url' => '',
        'link_text' => ''
    ), $atts));

    $link_text = $atts['link_text'];
    $link_url = $atts['link_url'];;

    $lightbox = "<a href='{$link_url}' data-featherlight='iframe' data-featherlight-iframe-height='100%' data-featherlight-iframe-width='100%'>{$link_text}</a>";
    return $lightbox;

}
add_shortcode( 'go_lightbox_url','go_lightbox_url' );


//Creates an excerpt for grabbed post
function go_post_grabber_content_exerpt_shortcode() { 
	echo '';
	query_posts( 'showposts=2' ); 
	while ( have_posts() ) : the_post(); 
	?>
		<h5>
			<a href="<?php the_permalink() ?>">
				<?php the_title(); ?>
			</a>
		</h5>
	<?php 
		the_excerpt( __( '(more?)' ) );
	endwhile;
}

//Gets the user's display name
function go_get_displayname_function( $atts, $content = null ) {
	if ( is_user_logged_in() ) {
		$current_user = wp_get_current_user();
		return "<span id='go-displayname'>{$current_user->display_name}</span>";
	} else { 
		return '<span id="go-visitor">Visitor</span>'; 
	}
}
add_shortcode( 'get_displayname', 'go_get_displayname_function' );
add_shortcode( 'go_get_displayname', 'go_get_displayname_function' );

//Gets the users first name
function go_get_firstname_function( $atts, $content = null ) {
	if (is_user_logged_in() ) {
		$current_user = wp_get_current_user();
	    return "<span id='go-firstname'>{$current_user->user_firstname}</span>";
	} else { 
		return '<span id="go-visitor">Visitor</span>'; 
	}
}
add_shortcode( 'go_firstname', 'go_get_firstname_function' );

//Gets the users last name
function go_get_lastname_function( $atts, $content = null ) {
	if ( is_user_logged_in() ) {
		$current_user = wp_get_current_user();
	    return "<span id='go-lastname'>{$current_user->user_lastname}</span>";
	} else { 
		return '<span id="go-visitor">Visitor</span>'; 
	}
}
add_shortcode( 'go_lastname', 'go_get_lastname_function' );


//Gets the users login
function go_get_login_function( $atts, $content = null ) {
	if ( is_user_logged_in() ) {
	    $current_user = wp_get_current_user();
	    return "<span id='go-username'>{$current_user->user_login}</span>";
	} else { 
		return '<span id="go-visitor">Visitor</span>'; 
	}
}
add_shortcode( 'go_loginname', 'go_get_login_function' );

// creates shortcode for page grab function
add_shortcode( 'page_grab', 'go_page_grabber_shortcode' );
add_shortcode( 'go_page_grab', 'go_page_grabber_shortcode' );


// creates shortcode for post grab function
add_shortcode( 'post_grab', 'go_post_grabber_shortcode' );
add_shortcode( 'go_post_grab', 'go_post_grabber_shortcode' );


//Adds a link to the most recent post
function go_latest_post_url_shortcode( $atts, $content = null ) { 
	$atts = shortcode_atts(
		array(  
			"cat" => '',
			"usetitle" => 'yes'   
		), 
		$atts
	);
	$catquery = new WP_Query( "cat={$atts['cat']}&posts_per_page=1" );
	$usetitle = $atts['usetitle'];
	while( $catquery->have_posts () ) : $catquery->the_post();
	?>
		<a href="<?php the_permalink(); ?>">
			<?php 
			if ( $usetitle = "yes" ) {
				the_title();
			} else { 
				return '';
			}
			?>
		</a>
	<?php 
	endwhile;
}
add_shortcode ( 'latest_post', 'go_latest_post_url_shortcode' );
add_shortcode ( 'go_latest_post', 'go_latest_post_url_shortcode' );


//Makes content within tags only visible to people who aren't logged in
function go_visitor_only_content_function( $atts, $content = null ) {
	if ( is_user_logged_in() ) {
    	echo '';
	} else {
    	return '<div id="visitor-only-content">'.do_shortcode( $content ).'</div>';
	}
}
add_shortcode ( 'visitor_only_content', 'go_visitor_only_content_function' );
add_shortcode ( 'go_visitor_only_content', 'go_visitor_only_content_function' );


//Makes content within tags visible to only people who are logged in  
function go_user_only_content_function( $atts, $content = null ) {
	if ( is_user_logged_in() ) {
    	return '<div id="user-only-content">'.do_shortcode( $content).'</div>';
	} else {
    	return '';
	}
}
add_shortcode ( 'user_only_content', 'go_user_only_content_function' );
add_shortcode ( 'go_user_only_content','go_user_only_content_function' );


//Makes content within tags visible to admins only
function go_admin_only_content_function( $atts, $content = null ) {
	if ( current_user_can( 'manage_options' ) ) {
		return '<div id="admin-only-content" style="color:red"> <i>' .do_shortcode( $content). '</i> </div>';
	} else {
		return '';
	}
}
add_shortcode ( 'admin_only_content', 'go_admin_only_content_function' );
add_shortcode ( 'go_admin_only_content', 'go_admin_only_content_function' );



//Adds the ability to put a login box anywhere it is needed
function go_login( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			"size" => 'medium',
			"redirect" => 'current',
			"lostpass" => 'yes'
		), 
		$atts
	);
	
	// Define Redirects for Login/Logout
	switch ( $atts['redirect'] ) {
		case "current":
			$current_page_logout = wp_logout_url( get_permalink() );
			$current_page_login  = $_SERVER["REQUEST_URI"];
			break;
		case 'dashboard':
			$current_page_logout = wp_logout_url();
			$current_page_login  = wp_login_url();
			break;
		case 'homepage':
			$current_page_logout = wp_logout_url( home_url() );
			$current_page_login  = wp_login_url( home_url() );
			break;
	}
	
	// End Define Redirects
	// Define Size 
	if ( $atts['size'] == 'medium' ) {
		$input_size = '20';
	} elseif ( $atts['size'] == 'small' ) {
		$input_size = '10';
	} elseif ( $atts['size'] == 'large' ) {
		$input_size = '30';
	} else {
		$input_size = '20';
	}
	//End Define Size
	
	// Begin Form
	if ( is_user_logged_in() ) { 
	?>
		<a class="submit" href="<?php echo ( $current_page_logout ); ?>" title="Logout">Logout</a>
    <?php
	} else {
		?>
		<form name="loginform" id="loginform" action="<?php echo get_option( 'home' ); ?>/wp-login.php" method="post">
		<p>
			<label>Username</br>
				<input type="text" name="log" id="user_login" class="input" value="" size="<?php echo $input_size; ?>" tabindex="10"/>
			</label>
		</p>
		<p>
			<label>Password</br>
				<input type="password" name="pwd" id="user_pass" class="input" value="" size="<?php echo $input_size; ?>" tabindex="20"/>
			</label>
		</p>
		<p class="forgetmenot">
			<label>
				<input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="90" /> Remember Me
			</label>
		</p>
		<input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="Log In" tabindex="100"/>
		<input type="hidden" name="redirect_to" value="<?php echo ( $current_page_login); ?>"/>
		<input type="hidden" name="testcookie" value="1"/>
		</form>
		<?php 	
		if ( $atts['lostpass'] == true ) { 
		?>
				<a href="<?php echo get_option( 'home' ); ?>/wp-login.php?action=lostpassword" title="Password Lost and Found">Lost your password?</a>
		<?php 
		} elseif ( $atts['lostpass'] == false ) { 
			echo ''; 
		} else {
		?> 
			<a href="<?php echo get_option( 'home' ); ?>/wp-login.php?action=lostpassword" title="Password Lost and Found">Lost your password?</a>
		<?php 
		} 
	}
}
add_shortcode ( 'sb_login', 'go_login' );
add_shortcode ( 'go_login', 'go_login' );

function go_get_category() {
	$terms = get_taxonomies();
	$post_id = get_the_ID();
	$nonce_terms = wp_create_nonce( 'go_get_all_terms_' . $post_id );
	$nonce_posts = wp_create_nonce( 'go_get_all_posts_' . $post_id );
	?>
    <script type="text/javascript">
		var go_ajaxurl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
		function go_get_all_tasks( el ) {
			var el = jQuery( el );
			if ( el.prop( "checked" ) ) {
				var val = el.val();
			} else {
				jQuery( '#' + el.val() + '_terms' ).remove();
				jQuery( '#go_queried_posts_' + el.val() ).remove();
			}
			jQuery.ajax({
				type:"POST", 
				url: go_ajaxurl, 
				data: {
					_ajax_nonce: '<?php echo $nonce_terms; ?>',
					action: 'go_get_all_terms',
					taxonomy: val,
				}, 
				success: function( res ) {
					if ( -1 !== res ) {
						el.parent().after( res );
					}
				}
			});
		}
		function go_get_all_posts( taxonomy ) {
			var terms = [];
			jQuery( '#go_queried_posts_' + taxonomy ).remove();
			jQuery( '.term' ).each(function() {
				el = jQuery( this );
				if ( el.prop( 'checked' ) ) {
					terms.push( el.val() );
				}
			});
			jQuery.ajax({
				type: "POST",
				url: go_ajaxurl,
				data:{
					_ajax_nonce: '<?php echo $nonce_posts; ?>',
					action: 'go_get_all_posts',
					taxonomy: taxonomy,
					terms: terms,
				},
				success: function( res ) {
					if ( -1 !== res ) {
						jQuery( '#' + taxonomy + '_terms' ).after( res );
					}
				}
			});
		}
	</script>
    <?php
	echo '<div id="taxonomies" style="padding: 0px; margin: 0px;">';
	foreach ( $terms as $term ) {
		if ( $term == 'post_tag' || $term == 'task_categories' || $term == 'task_focus_categories' ) {
			echo '<div style="padding: 0px; margin: 0px;"><input type="checkbox" id="chk" value="'.$term.'" onClick="go_get_all_tasks(this)">'.$term.'</div><br/>';
		}
	}
	echo '</div>';
}

add_shortcode( 'go_get_category', 'go_get_category' );
function go_get_all_terms() {
	check_ajax_referer( 'go_get_all_terms_' . get_the_ID() );

	$taxonomy = ( ! empty( $_POST['taxonomy'] ) ? sanitize_key( $_POST['taxonomy'] ) : '' );
	if ( $taxonomy != '' ) {
		echo "<div id='{$taxonomy}_terms'>";
	}
	if ( $taxonomy ) {
		$terms = get_terms( $taxonomy );
		foreach ( $terms as $term ) {
			echo '<input type="checkbox" class="term" value="'.$term->name.'" name="'.$term->name.'" onClick="go_get_all_posts(\''.$taxonomy.'\' )"/>'.$term->name.'<br/>';
		}
	}
	echo '</div>';
	die();
}

function go_get_all_posts() {
	check_ajax_referer( 'go_get_all_posts_' . get_the_ID() );

	$taxonomy = ( ! empty( $_POST['taxonomy'] ) ? sanitize_key( $_POST['taxonomy'] ) : '' );
	$terms = ( ! empty( $_POST['terms'] ) ? (array) $_POST['terms'] : array() );
	$posts = get_posts(
		array(
			'posts_per_page' => -1,
			'post_type' => 'tasks',
			'orderby' => 'ID',
			'order' => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => $taxonomy,
					'field' => 'name',
					'terms' => $terms
				)
			)
		)
	);	
	echo "<div id='go_queried_posts_{$taxonomy}' class='go_queried_posts'>";
	foreach ( $posts as $post ) {
		echo '<a href="'.get_permalink( $post->ID).'" target="_blank">'.get_the_title( $post->ID).'</a><br/>';	
	}
	echo '</div>';
	die();
}

add_shortcode( 'go_task_pod', 'go_task_pod_tasks' );
function go_task_pod_tasks( $atts ) {
	global $wpdb;
	$go_task_table_name = "{$wpdb->prefix}go";
	$current_tasks = get_posts( 
		array(
			'posts_per_page' => -1,
			'post_type' => 'tasks',
			'orderby' => 'ID',
			'order' => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'task_pods',
					'field' => 'slug',
					'terms' => array( strtolower( $atts['pod_name'] ) )
				)
			)
		)
	);
	$user_id = get_current_user_id();

	$task_in_pod_args = array( $user_id );
	foreach ( $current_tasks as $curr_task_obj ) {
		$task_in_pod_args[] = $curr_task_obj->ID;
	}

	$task_in_pod_query = "
		SELECT post_id, status 
		FROM {$go_task_table_name} 
		WHERE uid = %d AND post_id IN (";
	for ( $i = 0; $i < count( $current_tasks ); $i++ ) {
		if ( 0 !== $i ) {
			$task_in_pod_query .= ',';
		}
		$task_in_pod_query .= '%d';
	}
	$task_in_pod_query .= ')';

	$task_in_pod = $wpdb->get_results( $wpdb->prepare( $task_in_pod_query, $task_in_pod_args ) );

	$pod_task_statuses = array();
	foreach ( $task_in_pod as $task_data ) {
		$pod_task_statuses[ $task_data->post_id ] = $task_data->status;
	}
	$output_str = '';
	$tasks_finished = 0;

	$pods_options = get_option( 'go_task_pod_globals' );
	$name_entered = $atts['pod_name'];
	$slug = strtolower( trim( preg_replace( '/[^A-Za-z0-9-]+/', '-', $name_entered ) ) );
	$stage_required = $pods_options[ $slug ]['go_pod_stage_select'];
	foreach ( $current_tasks as $curr_task ) {	
		if ( 'third_stage' == $stage_required ) {
			if ( isset( $pod_task_statuses[ $curr_task->ID ] ) && $pod_task_statuses[ $curr_task->ID ] >= 3 ) {
				$tasks_finished++;
				$output_str .= '<div class="pod_finished" name="pod_div" value=""><a href="'.get_permalink( $curr_task->ID ).'" class="pod_link">'.get_the_title( $curr_task->ID ).'</a></div><br/>';
			} else if ( ! isset( $pod_task_statuses[ $curr_task->ID ] ) || $pod_task_statuses[ $curr_task->ID ] < 3 ) {
				$output_str .= '<div class="pod_unfinished" name="pod_div" value=""><a href="'.get_permalink( $curr_task->ID ).'" class="pod_link">'.get_the_title( $curr_task->ID ).'</a></div><br/>';
			}
		} else {
			if ( isset( $pod_task_statuses[ $curr_task->ID ] ) && $pod_task_statuses[ $curr_task->ID ] >= 4 ) {
				$tasks_finished++;
				$output_str .= '<div class="pod_finished" name="pod_div" value=""><a href="'.get_permalink( $curr_task->ID ).'" class="pod_link">'.get_the_title( $curr_task->ID ).'</a></div><br/>';
			} else if ( ! isset( $pod_task_statuses[ $curr_task->ID ] ) || $pod_task_statuses[ $curr_task->ID ] < 4 ) {
				$output_str .= '<div class="pod_unfinished" name="pod_div" value=""><a href="'.get_permalink( $curr_task->ID ).'" class="pod_link">'.get_the_title( $curr_task->ID ).'</a></div><br/>';
			}
		}
	}
	$previous_pod_slug = ( ! empty( $pods_options[ $slug ]['go_previous_pod'] ) ? $pods_options[ $slug ]['go_previous_pod'] : '' );
	if ( ! empty( $previous_pod_slug ) ) {
		$previous_pod_tasks_finished = 0;
		$previous_pod_tasks_required = $pods_options[ $previous_pod_slug ]['go_pod_number'];
		$previous_pod_stage_required = $pods_options[ $previous_pod_slug ]['go_pod_stage_select'];
		$previous_tasks = get_posts( 
			array(
				'posts_per_page' => -1,
				'post_type' => 'tasks',
				'orderby' => 'ID',
				'order' => 'ASC',
				'tax_query' => array(
					array(
						'taxonomy' => 'task_pods',
						'field' => 'slug',
						'terms' => array( $previous_pod_slug )
					)
				)
			)
		);
		$previous_tasks_in_pod_args = array( $user_id );
		foreach ( $previous_tasks as $prev_task_obj ) {
			$previous_tasks_in_pod_args[] = $prev_task_obj->ID;
		}
		$previous_tasks_in_pod_query = "
			SELECT post_id, status 
			FROM {$go_task_table_name} 
			WHERE uid = %d AND post_id IN (";
		for ( $x = 0; $x < count( $previous_tasks ); $x++ ) {
			if ( 0 !== $x ) {
				$previous_tasks_in_pod_query .= ',';
			}
			$previous_tasks_in_pod_query .= '%d';
		}
		$previous_tasks_in_pod_query .= ')';

		$previous_task_statuses = $wpdb->get_results(
			$wpdb->prepare(
				$previous_tasks_in_pod_query,
				$previous_tasks_in_pod_args
			)
		);

		$previous_pod_task_statuses = array();
		foreach ( $previous_task_statuses as $task_status ) {
			$previous_pod_task_statuses[ $task_status->post_id ] = $task_status->status;
		}
		foreach ( $previous_tasks as $prev_task ) {
			if ( 'third_stage' == $previous_pod_stage_required ) {
				if ( isset( $previous_pod_task_statuses[ $prev_task->ID ] ) && $previous_pod_task_statuses[ $prev_task->ID ] >= 3 ) {
					$previous_pod_tasks_finished++;
				}
			} else {
				if ( isset( $previous_pod_task_statuses[ $prev_task->ID ] ) && $previous_pod_task_statuses[ $prev_task->ID ] >= 4 ) {
					$previous_pod_tasks_finished++;
				}
			}
		}
	}
	
	$tasks_required = $pods_options[ $slug ]['go_pod_number'];
	$next_pod = $pods_options[ $slug ]['go_next_pod_select'];
	$next_pod_slug = strtolower( trim( preg_replace( '/[^A-Za-z0-9-]+/', '-', $next_pod ) ) );
	$tasks_plural_name = get_option( 'go_tasks_plural_name' );
	if ( 'third_stage' === $stage_required ) {
		$stage = get_option( 'go_third_stage_name' );
	} else {
		$stage = get_option( 'go_fourth_stage_name' );
	}
	if ( ! empty( $previous_pod_slug ) && $previous_pod_tasks_finished < $previous_pod_tasks_required ) {
		$previous_pod_name = $pods_options[ $previous_pod_slug ]['go_pod_name'];
		$previous_pod_link = $pods_options[ $previous_pod_slug ]['go_pod_link'];
		return "<b>The previous Pod must be finished first: <a href='".
			(
				! empty( $previous_pod_link ) ?
				esc_url( $previous_pod_link ) :
				'#'
			).
			"' target='_top'>{$previous_pod_name}</a></b><br/>";
	}
	if ( '...' !== $next_pod ) {
		if ( $tasks_finished >= $tasks_required ) {
			$pod_link = $pods_options[ $next_pod_slug ]['go_pod_link'];
			return "{$output_str}<b>Continue to next Pod: <a href='{$pod_link}' target='_top'>{$next_pod}</a></b><br/>";
		} else {
			return "{$output_str}<b>Stage required to complete: {$stage}<br/>You have finished {$tasks_finished} of {$tasks_required} {$tasks_plural_name} required to continue to the next Pod.</b>";
		}
	} else {		
		if ( $tasks_finished >= $tasks_required ) {
			return "{$output_str}<b>You have completed this Pod Chain.</b><br/>";
		} else {
			return "{$output_str}<b>Stage required to complete: {$stage}<br/>You have finished {$tasks_finished} of {$tasks_required} {$tasks_plural_name} required to complete this Pod.</b>";
		}
	}
}

add_filter( 'mce_buttons', 'go_shortcode_button_add_button', 0);
function go_shortcode_button_add_button( $buttons ) {

        array_push($buttons, "separator", "go_shortcode_button");
        return $buttons;
}

add_filter( 'mce_external_plugins', 'go_shortcode_button_register' );
function go_shortcode_button_register( $plugin_array ) {
    $is_admin = go_user_is_admin();
    if($is_admin) {
        $url = plugins_url("../js/js/go_shortcode_mce.js", __FILE__);
        $plugin_array['go_shortcode_button'] = $url;
        return $plugin_array;
    }
}

// from go_open_badge.php
add_shortcode( 'go_award_badge', 'go_award_badge' );
?>