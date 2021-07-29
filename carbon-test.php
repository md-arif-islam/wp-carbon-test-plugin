<?php
/*
Plugin Name: Carbon test
Plugin URI:
Description:
Version: 1.0
Author: Arif Islam
Author URI: arifislam.techviewing.com
License: GPLv2 or later
Text Domain: carbontest
Domain Path: /languages/
*/

use Carbon_Fields\Container;
use Carbon_Fields\Field;

require_once "vendor/autoload.php";

function carbontest_boot() {
	\Carbon_Fields\Carbon_Fields::boot();
}

add_action( 'plugin_loaded', 'carbontest_boot' );

function carbontest_metabox_demo() {
	Container::make( 'theme_options', 'Sample Metabox' )
	         ->where( 'post_type', '=', 'page' )
	         ->add_fields( [
		         /*Field::make( 'text', 'carbontest_address' )->set_default_value( 'Sample Address' ),
		         Field::make( 'text', 'carbontest_opening' )->set_default_value( 'Sat-Thu 10M-9PM' ),
		         Field::make( 'checkbox', 'carbontest_isopen', 'Is Open' )->set_option_value( 'yes' ),
		         Field::make( 'image', 'carbontest_image', __( 'Image' ) ),
		         Field::make( 'media_gallery', 'carbontest_media_gallery', __( 'media_gallery' ) ),
		         Field::make( 'html', 'crb_information_text' )
		              ->set_html( '<h2>Lorem ipsum</h2><p>Quisque mattis ligula.</p>' ),
		         Field::make( 'multiselect', 'crb_available_colors', __( 'Available Colors' ) )
		              ->add_options( array(
			              'red' => 'Red',
			              'green' => 'Green',
			              'blue' => 'Blue',
		              ) ),*/
		         Field::make( 'complex', 'crb_media_item' )
		              ->add_fields( 'photograph', array(
			              Field::make( 'image', 'image' ),
			              Field::make( 'text', 'caption' ),
		              ) )
		              ->add_fields( 'movie', array(
			              Field::make( 'file', 'video' ),
			              Field::make( 'text', 'title' ),
			              Field::make( 'text', 'length' ),
		              ) ),


	         ] );

	Container::make( 'post_meta', 'Slider Data' )
	         ->where( 'post_type', '=', 'page' )
	         ->add_fields( array(
		         Field::make( 'complex', 'crb_slides' )
		              ->add_fields( array(
			              Field::make( 'image', 'image' ),
			              Field::make( 'complex', 'slide_fragments' )
			                   ->add_fields( array(
				                   Field::make( 'text', 'fragment_text' ),
				                   Field::make( 'select', 'fragment_position' )
				                        ->add_options( array( 'Top Left', 'Top Right', 'Bottom Left', 'Bottom Right' ) ),
			                   ))
		              )),
	         ));
}

add_action( 'carbon_fields_register_fields', 'carbontest_metabox_demo' );
