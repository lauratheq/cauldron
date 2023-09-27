<?php

class Plugins {

	/**
	 * Holder for the instance object
	 * 
	 * @since	0.0.1
	 * 
	 * @var		object
	 */
	protected static $instance = null;

	/**
	 * Spawns an instance of this class if
	 * it does not exist and returns it
	 * 
	 * @since	0.0.1
	 * 
	 * @return	object $instance
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public static function init() {
		$plugin_system = self::get_instance();

		_p($plugin_system);
	}
}
