<?php
/*
Plugin Name: Advanced Custom Fields: Markdown
Description: A markdown-enhanced textarea field.
Version: 1.1.0
Requires PHP: 5.4
Author: Niche Studio
Author URI: https://nichestud.io
GitHub Plugin URI: https://github.com/nichestudio/ACF-Markdown
*/

namespace Niche\ACF;

if ( !defined( 'ABSPATH' ) ) exit;

class Markdown_Plugin {

	var $settings;

	function __construct() {

		$this->settings = [
			'version' => '1.1.0',
			'url'     => plugin_dir_url( __FILE__ ),
			'path'    => plugin_dir_path( __FILE__ ),
		];

		add_action( 'acf/include_field_types', [ $this, 'include_field' ] );
	}

	function include_field() {
		load_plugin_textdomain( 'acf-niche-markdown', false, plugin_basename( dirname( __FILE__ ) ) . '/lang/' );

		include_once 'fields/class-markdown.php';
	}

}

new Markdown_Plugin();
