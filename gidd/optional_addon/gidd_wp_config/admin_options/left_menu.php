<?php

$leftmenu	= ___subpage( 'Menu' );

//field
$arr_menu['edit.php'] = "Post";
$arr_menu['edit.php?post_type=page'] = "Page";
$arr_menu['upload.php'] = "Media";
$arr_menu['link-manager.php'] = "Links";
$arr_menu['themes.php'] = "Appearance";
$arr_menu['plugins.php'] = "Plugins";
$arr_menu['users.php'] = "Users";
$arr_menu['tools.php'] = "Tools";
$arr_menu['edit-comments.php'] = "Comments";
$arr_menu['options-general.php'] = "Setting";
$arr_menu['admin.php?page=g7b193a12'] = "Gidd Admin";


$menu 		= ___list( 'Left Menu', $arr_menu, 'Hide top-level menu on the left side. (Ctrl+Click) for selecting/deselecting items' );
$remove_all = ___checkbox( 'Remove menu items', 'Remove all the items in admin left menu, footer, screen options and help tab.' );

//class
$menu->_class = "gd-chosen";


//add javascript to head for custom registered page
add_action('___head_g0776eb65', '___head_g0776eb65');
function ___head_g0776eb65(){
?>

	<style type="text/css">	
		.wp-admin select.multiselect{ width: 180px; height: 160px; display: block; }
		.wp-admin select.multiselect option{ padding: 2px 5px; }
	</style>

<?php
}

//array of fields
$arr_opt = array( $remove_all, $menu );
___section( array ( 'Gidd WP Config', 'g0776eb65' ), $leftmenu, $arr_opt, "<b>Remove default dashboard metaboxes.</b>" );
unset( $arr_opt );

/** end */