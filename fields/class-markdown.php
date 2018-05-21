<?php

namespace Niche\ACF;

if ( !defined( 'ABSPATH' ) ) exit;

class Markdown_Field extends \acf_field {

	function __construct( $plugin_settings ) {
		$this->plugin_settings = $plugin_settings;
		parent::__construct();
	}

	function initialize() {

		$this->name = 'niche_markdown';
		$this->label = __( 'Markdown', 'acf-niche-markdown' );
		$this->category = 'content';
		$this->defaults = [
			'toolbar' => 1,
			'spellcheck' => 1,
		];

	}

	function render_field_settings( $field ) {

		acf_render_field_setting( $field, [
			'label'        => __( 'Show toolbar', 'acf-niche-markdown' ),
			'type'         => 'true_false',
			'name'         => 'toolbar',
			'ui'           => 1,
			'ui_on_text'   => 'Yes',
			'ui_off_text'  => 'No',
		] );

		acf_render_field_setting( $field, [
			'label'        => __( 'Spellchecker', 'acf-niche-markdown' ),
			'instructions' => __( 'Note: Only highlights errors, does not provide suggestions.', 'acf-niche-markdown' ),
			'type'         => 'true_false',
			'name'         => 'spellcheck',
			'ui'           => 1,
			'ui_on_text'   => 'Yes',
			'ui_off_text'  => 'No',
		] );

	}

	function render_field( $field ) {

		$atts = [];
		$string_atts = [ 'id', 'class', 'name', 'value', 'placeholder', 'rows', 'maxlength' ];
		$data_atts = [ 'toolbar', 'spellcheck' ];
		$boolean_atts = [ 'readonly', 'disabled', 'required' ];

		foreach ( $string_atts as $k ) {
			if ( isset( $field[ $k ] ) ) $atts[ $k ] = $field[ $k ];
		}

		foreach ( $data_atts as $k ) {
			if ( isset( $field[ $k ] ) ) $atts[ "data-$k" ] = $field[ $k ];
		}

		foreach ( $boolean_atts as $k ) {
			if ( !empty( $field[ $k ] ) ) $atts[ $k ] = $k;
		}

		$atts = acf_clean_atts( $atts );

		acf_textarea_input( $atts );

	}

	function input_admin_enqueue_scripts() {
		$url     = $this->plugin_settings['url'];
		$version = $this->plugin_settings['version'];

		wp_enqueue_script( 'acf-niche-markdown-inscrybmde', "{$url}assets/js/inscrybmde-1.11.3.min.js", null, $version );
		wp_enqueue_script( 'acf-niche-markdown', "{$url}assets/js/input.js", [ 'acf-input' ], $version );

		wp_enqueue_style( 'acf-niche-markdown-inscrybmde', "{$url}assets/css/inscrybmde-1.11.3.min.css", null, $version );
		//wp_enqueue_style( 'acf-niche-markdown', "{$url}assets/css/input.css", [ 'acf-input' ], $version );

	}

	function format_value( $value, $post_id, $field ) {

		if ( empty( $value ) ) {
			return $value;
		}

		$parser = new \cebe\markdown\GithubMarkdown();

		$parser->html5 = true;
		$parser->enableNewlines = true;

		return $parser->parse( $value );
	}

}

// Pass plugin settings to field
new Markdown_Field( $this->settings );
