<?php

/**
 * A class for loading our plugin.
 *
 * @package WordPress
 * @subpackage Bananas
 * @since Bananas 0.1
 */

namespace Bananas;

new Bootstrap;

class Bootstrap {

	function __construct() {

		$this -> load();

		$this -> create();

	}
	
	/**
	 * Load our plugin files.
	 * 
	 * @return boolean Returns FALSE if it loads all of its files, else TRUE.
	 */
	function load() {

		// For each php file in the inc/ folder, require it.
		foreach( glob( BANANAS_PATH . 'inc/*.php' ) as $filename ) {

			require_once( $filename );

		}

		return TRUE;

	}

	/**
	 * Instantiate and store a bunch of our plugin classes.
	 */
	function create() {

		global $bananas;

		$bananas = new \stdClass();

		$bananas -> settings              = new Settings;
		$bananas -> meta                  = new Meta;
		$bananas -> enqueue               = new Enqueue;		
		$bananas -> subsite_control_panel = new Subsite_Control_Panel;
		$bananas -> dashboard_widget      = new Dashboard_Widget;

		if( is_multisite() ) {
			$bananas -> network_control_panel = new Network_Control_Panel;
		}

		return $bananas;

	}

}