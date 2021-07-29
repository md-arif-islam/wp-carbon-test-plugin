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
use Carbon_Fields\Block;

require_once "vendor/autoload.php";

function carbontest_boot() {
	\Carbon_Fields\Carbon_Fields::boot();
}

add_action( 'plugin_loaded', 'carbontest_boot' );

function carbontest_metabox_demo() {

	wp_enqueue_style( 'carbontest-style', plugin_dir_url( __FILE__ ) . '/assets/css/carbontest-style.css' );
	wp_enqueue_script( 'carbontest-js', plugin_dir_url( __FILE__ ) . '/assets/js/main.js', array( 'jquery' ), time(), true );


	Block::make( __( 'According' ) )
	     ->add_fields( array(
		     Field::make( 'complex', 'crb_according', __( 'Slider' ) )
                 ->set_layout('tabbed-horizontal')
		          ->add_fields( array(
			          Field::make( 'text', 'heading', __( 'Block Heading' ) ),
			          Field::make( 'textarea', 'content', __( 'Block Content' ) ),
		          ) )
	     ) )
	     ->set_style( 'carbontest-style' )
	     ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
		     ?>
             <div class="block accordion-container">
			     <?php foreach ( $fields['crb_according'] as $field ) {
				     ?>
                     <h1 class="title"><?php echo $field['heading'] ?></h1>
                     <div class="body">
                         <p><?php echo $field['content'] ?></p>
                     </div>
				     <?php
			     } ?>
             </div>
		     <?php
	     } );
}

add_action( 'carbon_fields_register_fields', 'carbontest_metabox_demo' );
