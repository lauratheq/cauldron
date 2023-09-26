<?php

class Options {
	/**
	 * Gets an option by its name
	 * 
	 * @since	0.0.1
	 * 
	 * @param	string	$name	the name of the option
	 * 
	 * @return	mixed	either this returns the value of the option or void
	 */
	public static function get( $name ) {
		$db = DB::get_instance();

		$options_query = "SELECT * FROM options WHERE `name` = '" . $name . "'";
		$options_result = $db->get_results( $options_query );

		if ( ! empty( $options_result ) ) {
			$options_result = $options_result[0];
			$value = Helpers::maybe_unserialize( $options_result[ 'value' ] );
			return $value;
		} else {
			return;
		}
	}

	/**
	 * Gets an raw option by its name
	 * 
	 * @since	0.0.1
	 * 
	 * @param	string	$name	the name of the option
	 * 
	 * @return	mixed	either this returns the value of the option or void
	 */
	public static function get_raw( $name ) {
		$db = DB::get_instance();

		$options_query = "SELECT * FROM options WHERE `name` = '" . $name . "'";
		$options_result = $db->get_results( $options_query );

		if ( ! empty( $options_result ) ) {
			$options_result = $options_result[0];
			$options_result[ 'value' ] = Helpers::maybe_unserialize( $options_result[ 'value' ] );
			return $options_result;
		} else {
			return;
		}
	}

	/**
	 * Adds an option with its name and value. The value might be serialized if 
	 * it is an object or array. Will be redirected to self::update if the option
	 * does exist.
	 * 
	 * @since	0.0.1
	 * 
	 * @param	string	$name	the name of the option
	 * @param	mixed	$value	the name of the option
	 * 
	 * @return	void
	 */
	public static function add( $name, $value ) {
		$db = DB::get_instance();
	
		// check if exists and revert to update
		$option_check = self::get_raw( $name );
		if ( ! empty( $option_check ) ) {
			self::update( $name, $value );
			return;
		}

		$value = Helpers::maybe_serialize( $value );
		$db->query( "INSERT INTO options SET `name` = '" . $name . "', `value` = '" . $value . "'" );
	}

	/**
	 * Updates an option with its name and value. The value might be serialized if 
	 * it is an object or array. Will be redirected to self::add if the option does
	 * not exist.
	 * 
	 * @since	0.0.1
	 * 
	 * @param	string	$name	the name of the option
	 * @param	mixed	$value	the name of the option
	 * 
	 * @return	void
	 */
	public static function update( $name, $value ) {
		$db = DB::get_instance();

		// check if exists and revert to add
		$option_check = self::get_raw( $name );
		if ( empty( $option_check ) ) {
			self::add( $name, $value );
			return;
		}

		$value = Helpers::maybe_serialize( $value );
		$db->query( "UPDATE options SET `name` = '" . $name . "', `value` = '" . $value . "' WHERE `id` = '" . $option_check['id'] . "'" );
	}

	/**
	 * Removes an option from the database
	 * 
	 * @since	0.0.1
	 * 
	 * @param	string	$name	the name of the option
	 * 
	 * @return	void
	 */
	public static function remove( $name ) {
		$db = DB::get_instance();
		$db->query( "DELETE FROM options WHERE `name` = '" . $name . "'" );
	}
}
