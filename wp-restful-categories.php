<?php
if(in_array("wp-restful/wp-restful.php",get_option('active_plugins'))) {
/*
Plugin Name: WP-RESTful Category Plugin
Plugin URI: http://www.joseairosa.com/2010/05/17/wordpress-plugin-parallel-loading-system/
Description: Plugin to add category module to WP-RESTful plugin
Author: Jos&eacute; P. Airosa
Version: 0.1
Author URI: http://www.joseairosa.com/

Copyright 2010  José P. Airosa  (email : me@joseairosa.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
	
//========================================
// Load Widget
//========================================
require_once WP_PLUGIN_DIR."/wp-restful-categories-plugin/wp-restful-categories-widget.php";
	
//========================================
// Install / Uninstall Plugin
//========================================
function wpr_categories_install() {
	$wpr_plugins = get_option("wpr_plugins");
	if(!is_array($wpr_plugins))
		$wpr_plugins = array(); 
	// Add our plugin as active
	$wpr_plugins['categories'] = "wp-restful-categories";
	update_option("wpr_plugins",$wpr_plugins);
}
function wpr_categories_uninstall() {
	$wpr_plugins = get_option("wpr_plugins");
	if(!is_array($wpr_plugins))
		$wpr_plugins = array(); 
	// Remove this plugin as active
	$wpr_active_plugins = array_diff($wpr_plugins,array("wp-restful-categories"));
	update_option("wpr_plugins",$wpr_active_plugins);
}

function wpr_categories_fields() {
	return array('Categories' => array(
		'cat_ID' => 'Category ID',
		'name' => 'Category Name',
		'description' => 'Category Description',
		'parent' => 'Category Parent (ID)',
		'count' => 'Category Usage Count',
		'slug' => 'Category Slug (nice name)'
	));
}
wpr_add_plugin('wpr_categories_fields');

function wpr_category_pluralization() {
	return array('category' => 'categories');
}
wpr_add_pluralization('wpr_category_pluralization');

add_action('activate_'.plugin_basename(__FILE__), 'wpr_categories_install');
add_action('deactivate_'.plugin_basename(__FILE__), 'wpr_categories_uninstall');

}
?>