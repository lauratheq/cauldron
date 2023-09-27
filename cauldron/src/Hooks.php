<?php

class Hooks {

	/**
	 * Holder for the instance object
	 * 
	 * @since	0.0.1
	 * 
	 * @var		object
	 */
	protected static $instance = null;

	/**
	 * Hooks stack holder
	 * 
	 * @since	0.0.1
	 * 
	 * @var	array
	 */
	public $hooks = [];

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

	/**
	 * Adds a calllback function to a certain user defined
	 * hook. There's also the posibility to add a priority
	 * for the hook whereas the lower the number the earlier
	 * it will be executed
	 * 
	 * @since	0.0.1
	 * 
	 * @param	string	$name		Name of the hook
	 * @param	string	$callback	Callback function name
	 * @param	int		$priority	Priority level, default = 10
	 * 
	 * @return	void
	 */
	public static function add( $name, $callback, $priority = 10 ) {
		$instance = self::get_instance();

		$hook_id = md5( serialize( [ $name, $callback, $priority ] ) );
		$hook = new Hook( $hook_id, $name, $callback, $priority );

		$instance->hooks[ $priority . '_' . $hook_id ] = $hook;
		ksort( $instance->hooks, SORT_NATURAL );
	}

	/**
	 * Removes a calllback function from a certain user defined
	 * hook.
	 * 
	 * @since	0.0.1
	 * 
	 * @param	string	$name		Name of the hook
	 * @param	string	$callback	Callback function name
	 * 
	 * @return	void
	 */
	public static function remove( $name, $callback ) {
		$instance = self::get_instance();

		foreach ( $instance->hooks as $hook_id => $hook ) {
			if ( $hook->name == $name && $hook->callback == $callback ) {
				unset( $instance->hooks[ $hook_id ] );
				break;
			}
		}
	}

	/**
	 * Executes a hook and calls the registered callback
	 * functions within their priority
	 * 
	 * @since	0.0.1
	 * 
	 * @param	string	$name		Name of the hook
	 * 
	 * @return	void
	 */
	public static function exec( $name ) {
		$instance = self::get_instance();

		foreach ( $instance->hooks as $hook ) {
			if ( $hook->name == $name ) {
				if ( is_callable( $hook->callback ) ) {
					call_user_func( $hook->callback );
					break;
				}
			}
		}
	}

	/**
	 * Applys a hook and calls the registered callback
	 * functions within their priority
	 * 
	 * @since	0.0.1
	 * 
	 * @param	string	$name		Name of the hook
	 * @param	mixed	$default	The default variable
	 * @param	array	$arguments	additional arguments
	 * 
	 * @return	mixed	returns the default if there is no callable hook registered
	 */
	public static function apply( $name, $default, $arguments = array() ) {
		$instance = self::get_instance();

		$rtn_value = $default;
		foreach ( $instance->hooks as $hook ) {
			if ( $hook->name == $name ) {
				if ( is_callable( $hook->callback ) ) {
					$rtn_value = call_user_func( $hook->callback, $rtn_value, $arguments );
				}
			}
		}

		return $rtn_value;
	}
}
