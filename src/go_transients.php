<?php
/**
 * Created by PhpStorm.
 * User: mmcmurray
 * Date: 9/9/18
 * Time: 9:32 PM
 */

/**
 * Get/set transient of term_ids of chains on a map by map term_id
 *
 * Reset on:
 * change to term (could now be a pod, etc.)        OK
 * change to term order --includes term-order.php   OK
 *
 * @param $term_id
 * @return mixed
 */
function go_get_map_chain_term_ids($term_id) {
    //global $wpdb;

    $taxonomy_name = 'task_chains';
    $key = 'go_get_map_chain_term_ids_' . $term_id;


    $data = get_transient($key);

    if ($data === false) {

        $args=array(
            'hide_empty' => false,
            'orderby' => 'order',
            'order' => 'ASC',
            'parent' => $term_id,
        );

        $data = get_terms($taxonomy_name,$args); //query 1 --get the chains
        $data = wp_list_pluck( $data, 'term_id' );

        set_transient($key, $data, 3600 * 24);
    }

    return $data;

}

/**
 * @param $term_id
 * @return mixed
 *
 * Delete on save or update of term
 */
function go_get_parent_map_id($term_id){

    $key = 'go_get_parent_map_id_' . $term_id;

    $data = get_transient($key);

    if ($data === false) {



        //find if term is a map
        //if not a map, get map_id
        $term = get_term($term_id, 'task_chains');
        //Get the parent object, if needed
        $termParent = ($term->parent == 0) ? $term : get_term($term->parent, 'task_chains');
        //GET THE ID FROM THE MAP OBJECT
        $data = $termParent->term_id;

        set_transient($key, $data, 3600 * 24);
    }

    return $data;

}

/**
 * @return mixed
 *
 * Delete on save or update of any term
 */
function go_get_maps_term_ids(){
    $key = 'go_get_maps_term_ids';

    $data = get_transient($key);

    if ($data === false) {
        $args = array('hide_empty' => false, 'orderby' => 'order', 'order' => 'ASC', 'parent' => 0, 'fields' => 'ids');
        //get all parent maps (chains with no parents)

        $data = get_terms('task_chains', $args);

        set_transient($key, $data, 3600 * 24);
    }

    return $data;

}

/**
 * Gets/sets transient of the term data
 *
 * Reset on Term save                               OK
 *
 * @param $term_id
 * @return array
 */
function go_term_data($term_id){
    $key = 'go_term_data_' . $term_id;
    $data = get_transient($key);

    if ($data !== false){
        $term_data = $data;

    }else {
        $term_data = array();
        $term = get_term($term_id);
        $term_name = $term->name;
        $term_data[] = $term_name;
        $term_custom = get_term_meta($term_id, '', true);
        $term_data[] = $term_custom;
        set_transient($key, $term_data, 3600 * 24);
    }
    return $term_data;

}

/**
 * gets/sets transient of post_ids assigned to a term, in order set on map
 * If run from map and also sets the transient data for each task if needed
 *
 * Reset on:
 * new task assigned --post saved
 * task removed --post saved
 * order changed -- post saved (any save)
 *
 * @param $term_id
 * @param $is_map
 * @return mixed
 */
function go_get_chain_posts($term_id, $is_map = false ){
    //global $wpdb;

    $key = 'go_get_chain_posts_' . $term_id;

    $data = get_transient($key);

    if ($data !== false){
        $data_ids = $data;

    }else {

        $args=array(
            'post_type'        => 'tasks',
            'tax_query' => array(
                array(
                    'taxonomy' => 'task_chains',
                    'field' => 'term_id',
                    'terms' => $term_id,
                )
            ),
            'orderby'          => 'meta_value_num',
            'order'            => 'ASC',
            'posts_per_page'   => -1,
            'meta_key'         => 'go-location_map_order_item',
            'post_status'      => 'publish',
            'suppress_filters' => true

        );

        $data = get_posts($args);

        if ($is_map) {
            foreach ($data as $task) {
                $post_id = $task->ID;
                go_post_data($post_id);
            }
        }

        $data_ids = wp_list_pluck( $data, 'ID' );
        set_transient($key, $data_ids, 3600 * 24);
        foreach ($data_ids as $post_id){
            $key = 'go_post_task_chain_' . $post_id;
            update_option( $key, $term_id, false );
        }

    }
    return $data_ids;
}

/**
 * Gets/sets transient of the post data for tasks and store items
 * [0]-title
 * [1]-status [published]
 * [2]-permalink
 * [3]-metadata
 * Reset on:
 * post save                                        OK
 *
 * @param $post_id
 * @return array
 */
function go_post_data($post_id){
    $key = 'go_post_data_' . $post_id;
    $data = get_transient($key);

    if ($data !== false){
        $task_data = $data;

    }else {
        $task_data = array();
        $task = get_post($post_id);
        $term_name = $task->post_title;
        $task_data[] = $term_name;//0
        $term_status = $task->post_status;
        $task_data[] = $term_status;//1
        $term_permalink = get_permalink($task);
        $task_data[] = $term_permalink;//2
        $term_custom = get_post_custom($post_id);
        $task_data[] = $term_custom;//3
        set_transient($key, $task_data, 3600 * 24);
    }
    return $task_data;

}

/**
 * Get/set transient of post_ids of tasks on a chain by map term_id
 *
 * Reset on:
 * new task assigned --post saved
 * task removed --post saved
 * order changed -- post saved
 *
 * @param $task_id
 * @return mixed
 */
/*
function go_get_chain_order ($term_id){
    $key = 'go_get_chain_order_' . $term_id;
    $data = get_transient( $key );
    if ($data !== false){
        $go_task_ids = $data;
    }else {
        if (!empty($term_id)) {
            $args = array('tax_query' => array(array('taxonomy' => 'task_chains', 'field' => 'term_id', 'terms' => $term_id,)), 'orderby' => 'meta_value_num', 'order' => 'ASC', 'posts_per_page' => -1, 'meta_key' => 'go-location_map_order_item', 'meta_value' => '', 'post_type' => 'tasks', 'post_mime_type' => '', 'post_parent' => '', 'author' => '', '
                    author_name' => '', 'post_status' => 'publish', 'suppress_filters' => true, 'fields' => 'ids');

            $go_task_ids = get_posts($args);
            set_transient($key, $go_task_ids, 3600 * 24);
            //wp_cache_set( $key, $go_task_ids );
        }
        else{
            $go_task_ids = array();
        }
    }
    return $go_task_ids;
}
*/

/**
 * Update transients on post save, delete or trash
 * @param  integer $post_id
 */
function go_update_task_post_save( $post_id ) {
    $post = get_post( $post_id );
    // Check for post type.
    if ( 'tasks' !== $post->post_type ) {
        return;
    }

        //delete task data transient
        $key = 'go_post_data_' . $post_id;
        delete_transient($key);


        //delete task chain transient for old and new task chain

        //delete old task chain transient
        //this is the original task_chain for this post
        //there is an option created/updated when the transient is created
        $key = 'go_post_task_chain_' . $post_id;
        $term_id = get_option($key);
        //delete the original task chain post_ids transient
        $key = 'go_get_chain_posts_' . $term_id;
        delete_transient($key);

        //delete new task chain transient
        get_post($post_id);
        $custom_fields = get_post_custom($post_id);
        $term_id = (isset($custom_fields['go-location_map_loc'][0]) ? $custom_fields['go-location_map_loc'][0] : null);
        $key = 'go_get_chain_posts_' . $term_id;
        delete_transient($key);


}

add_action( 'wp_trash_post', 'go_update_task_post_save' );//before sent to trash
add_action( 'delete_post', 'go_update_task_post_save' );//before delete
add_action( 'deleted_post', 'go_update_task_post_save' );//after delete
add_action( 'save_post', 'go_update_task_post_save' );//after save

/**
 * Update map on map/chain term
 * @param  integer $term_id
 */
function go_update_task_chain_term_save( $term_id ) {

    $key = 'go_get_map_chain_term_ids_' . $term_id;
    delete_transient( $key );

    $key = 'go_term_data_' . $term_id;
    delete_transient( $key );

    $key = 'go_get_parent_map_id_' . $term_id;
    delete_transient( $key );

    $key = 'go_get_maps_term_ids';
    delete_transient( $key );


}

add_action( "delete_task_chains", 'go_update_task_chain_term_save', 10, 4 );
add_action( "create_task_chains", 'go_update_task_chain_term_save', 10, 4 );
add_action( "edit_task_chains", 'go_update_task_chain_term_save', 10, 4 );
