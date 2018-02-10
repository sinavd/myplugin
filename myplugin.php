<?php
/*
Plugin Name: myplugin
Plugin URI: http://sinavd.ir
Description: this is <a href="sinavd.ir">my plugin</a> for test
Version: 1.0
Author: sina vadodi
Author URI: http://sinavd.ir
License: gold
*/

function display_facebook_element()
{
	echo "<input type='text' name='facebook_url' id='facebook_url' value='".get_option('facebook_url')."' />";
}

function display_twitter_element()
{
	echo "<input type='text' name='twitter_url' id='twitter_url' value='".get_option('twitter_url')."' />";
}

function display_theme_panel_fields()
{
	add_settings_section("section", "All Settings", null, "theme-panel");
	add_settings_field("twitter_url", "Titter Profile Url", "display_twitter_element", "theme-panel", "section");
	add_settings_field("facebook_url", "Facebook Profile Url", "display_facebook_element", "theme-panel", "section");
	add_settings_field("theme_layout", "do you want the layout to be responsive?", "display_layout_element", "theme-panel", "section");
	
	register_setting("section", "twitter_url");
	register_setting("section", "facebook_url");
	register_setting("section", "theme_layout");
}

function display_layout_element()
{
	echo "<input type='checkbox' name='theme_layout' id='theme_layout' value='1'";
	checked (1, get_option('theme_layout'), true);
	echo " />";
}

function theme_settings_page()
{
	echo "<div class='wrap'>";
	echo "<h1>Theme Panel</h1>";
	echo "<form method='post' action='options.php'>";
	settings_fields("section");
	do_settings_sections("theme-panel");
	submit_button();
	echo "</form>";
	echo "</div>";
}

function logo_display()
{
	echo "<input type='file' name='logo' />"
	echo get_option('logo');
}

function handle_logo_upload()
{
	if(!empty($_FILES["demo-file"]["tmp_name"]))
	{
		$urls = wp_handle_upload($_FILES["logo"], array("test_form" => FALSE));
		$temp = $urls["url"];
		return $temp;
	}
	return $options;
}

function sub_theme_settings_page() {}

function add_theme_menu_item()
{
	add_menu_page("عنوان منوی اصلی", "نمایش منوی اصلی", "manage_options", "theme-panel", "theme_settings_page", null, 99);
	add_submenu_page("theme-panel", "عنوان زیر منو", "نمایش زیر منو", "manage_options", "sub-theme-panel", "sub_theme_settings_page");
}

add_action("admin_init", "display_theme_panel_fields");
add_action("admin_menu", "add_theme_menu_item");

?>