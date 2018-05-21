<?php
/*
Plugin Name: Advanced Custom Fields: Markdown
Description: A markdown-enhanced textarea field.
Version: 1.0.0
Author: Niche Studio
Author URI: https://nichestud.io
*/

namespace Niche\ACF;

if ( !defined( 'ABSPATH' ) ) exit;

class Markdown_Plugin {

	var $settings;

	function __construct() {

		$this->settings = [
			'version' => '1.0.0',
			'url'     => plugin_dir_url( __FILE__ ),
			'path'    => plugin_dir_path( __FILE__ ),
		];

		$this->autoload();

		add_action( 'acf/include_field_types', [ $this, 'include_field' ] );
	}

	function autoload() {
		require __DIR__ . '/vendor/autoload.php';
	}

	function include_field() {
		load_plugin_textdomain( 'acf-niche-markdown', false, plugin_basename( dirname( __FILE__ ) ) . '/lang/' );

		include_once 'fields/class-markdown.php';
	}

}

new Markdown_Plugin();
