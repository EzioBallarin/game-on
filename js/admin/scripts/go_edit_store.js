jQuery( document ).ready( function() {
    var id = GO_EDIT_STORE_DATA.postid;
    var store_name = GO_EDIT_STORE_DATA.store_name;
    var link = "<a id=" + id + " class='go_str_item ab-item' >View " + store_name +" Item</a>"
    //console.log(link);
    jQuery('#wp-admin-bar-view').html(link);
});
