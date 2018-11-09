<?php

/**
 * Retrieves the status of a task for a specific user.
 *
 * Task "status" values are stored in the `go`.`status` column. Statuses outside the range of [0,5]
 * are not used for tasks, so this function is for tasks ONLY.
 *
 * @since 3.0.0
 *
 * @global wpdb $wpdb The WordPress database class.
 *
 * @param int $task_id The task ID.
 * @param int $user_id Optional. The user ID.
 * @return int|null The status (0,1,2,3,4,5) of a task. Null if the query finds nothing.
 */
function go_get_status( $task_id, $user_id = null, $task = null ) {
    global $wpdb;

    $key = 'go_get_status_' . $task_id;
    $data = wp_cache_get( $key );
    if ($data !== false){
        $task_status = $data;
    }else {
        if ($task != null){
            $task_status = $task['status'];
        }
        else{
            $go_task_table_name = "{$wpdb->prefix}go_tasks";

            if ( empty( $task_id ) ) {
                return null;
            }

            if ( empty( $user_id ) ) {
                $user_id = get_current_user_id();
            } else {
                $user_id = (int) $user_id;
            }

            $task_status = $wpdb->get_var(
                $wpdb->prepare(
                    "SELECT status 
			FROM {$go_task_table_name} 
			WHERE uid = %d AND post_id = %d",
                    $user_id,
                    $task_id
                )
            );

            if ( null !== $task_status && ! is_int( $task_status ) ) {
                $task_status = (int) $task_status;
            }
        }
        wp_cache_set ($key, $task_status, 'go_single');
    }


    return $task_status;
}

/**
 * @param $custom_fields
 * @param $user_id
 * @param $id
 * @param $task_name
 * @return bool
 */
function go_timer( $custom_fields, $user_id, $id, $task_name ) {

		$time_left = go_time_left ($custom_fields, $user_id, $id );//
		//get the start time from the go table
		$start_time = go_timer_start_time ( $id, $user_id );
        $mod = (isset($custom_fields['go_timer_settings_timer_mod'][0]) ?  $custom_fields['go_timer_settings_timer_mod'][0] : 0);

    //if start time is empty
		//the timer has never been started
		if ( empty($start_time)){
			$time_string = secondsToTime($time_left);
			//display message "you will have . . ."
			echo "<div class='go_timer_message'> <h3 class='go_error_red'>Timer</h3>This is a timed ".$task_name.".<br>You will have " . $time_string . " to complete this " . $task_name . " before your rewards are reduced by " . $mod . "%.";

			// Display Buttons
            $db_status = go_get_status($id, $user_id);
			echo "<div id='go_buttons' style='overflow: auto;'>";
            echo "<a id='go_abandon_task' onclick='go_timer_abandon();this.disabled = true;' style='float: left;'>Abandon</a>";
            echo "<button id='go_button' status='" . $db_status . "'  timer='true' button_type='timer' style='float: right;'>Start</button> ";

			echo "</div>";
            echo "</div>";

			//returning true stops the printing of the rest of the task because the timer is set but not started
			return true;
		}
		//The timer has been started before
		else {
		//else start time is set, display running timer or time's up message.
			$current_date = time(); //current date and time
			$timer_time = $time_left - $current_date;
            echo "<div class='go_timer_message'> <h3 class='go_error_red'>Timer</h3>";

            //if the time is up, display message
			if ($timer_time <= 0) {
				echo "<span>Time's up! Rewards have been reduced by " . $mod . "%.</span>";
				$time_left_ms = 0;
			}
			//else display running timer
			else{
					
				$time_left_ms = $time_left * 1000;
				echo "<span>You have a limited amount of time to complete this " . $task_name . " before rewards are reduced by " . $mod . "%.</span>";
				
			}
			echo "<div>";
            go_print_timer();
			echo "</div>";
			echo "</div>";

			echo "<script>jQuery(document).ready(function() {initializeClock('clockdiv', new Date( " . $time_left_ms . " ), true);});</script>";
			echo "<script>jQuery(document).ready(function() {initializeClock('go_timer', new Date( " . $time_left_ms . " ), true);});</script>";
			echo "<script>jQuery('#clockdiv').show();</script>";
			return false;
		}
}

/**
 * @param $seconds
 * @return string
 */
function secondsToTime($seconds) {
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$seconds");
    return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
}

/**
 * @param $id
 * @param $user_id
 * @return mixed
 */
function go_timer_start_time ($id, $user_id ) {
    global $wpdb;
    $go_task_table_name = "{$wpdb->prefix}go_tasks";

    //get the start time from the go table
    $start_time = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT start_time 
				FROM {$go_task_table_name} 
				WHERE post_id = %d AND uid = %d",
            $id,
            $user_id
        )
    );
    return $start_time;
}

/**
 * @param $custom_fields
 * @param $user_id
 * @param $id
 * @return false|int
 */
function go_time_left ($custom_fields, $user_id, $id ) {

    $start_time = go_timer_start_time ($id, $user_id );
    //get amount of time in seconds on the timer
    $days = $custom_fields['go_timer_settings_days'][0];
    $hours = $custom_fields['go_timer_settings_hours'][0];
    $minutes =  $custom_fields['go_timer_settings_minutes'][0];
    $seconds = $custom_fields['go_timer_settings_seconds'][0];
    $future_time = strtotime( "{$days} days", 0) + strtotime( "{$hours} hours", 0) + strtotime( "{$minutes} minutes", 0) + strtotime( "{$seconds} seconds", 0) ;
    $future_time = $future_time ;
    //get the start time from the go table
    if (empty($start_time)){
        //IF THIS IS THE FIRST TIME YOU CLICK START
        $time_left = $future_time;
    }else{
        $time_left = strtotime($start_time) + $future_time;
    }
    return $time_left;

}

/**
 *
 */
function go_print_timer () {
	?>

	<div id='clockdiv' style='display: none;'>  
		<div>    <span class='days'></span>    
			<div class='smalltext'>Days</div>  
		</div>  
		<div>    <span class='hours'></span>    
			<div class='smalltext'>Hours</div>  
		</div>  
		<div>    <span class='minutes'></span>    
			<div class='smalltext'>Minutes</div>  
		</div>  
		<div>    
			<span class='seconds'></span>    
			<div class='smalltext'>Seconds</div>  
		</div>
	</div>

	<?php
}