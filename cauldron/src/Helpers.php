<?php

function _p( $pee ) {
	print '<pre>';
	print_r( $pee );
	print '</pre>';
}
class Helpers {

	/**
	 * Tries to serialize a dataset
	 * 
	 * @since	0.0.1
	 * 
	 * @param	mixed	$data	the data to be serialized
	 * 
	 * @return	string	$data	the serialized data
	 */
	public static function maybe_serialize( $data ) {
		$data = Hooks::apply( 'maybe_serialize_raw', $data );
		if ( is_array( $data ) || is_object( $data ) ) {
			$data = serialize( $data );
		}
	
		$data = Hooks::apply( 'maybe_serialize', $data );
		return $data;
	}

	/**
	 * Tries to unserialize a dataset
	 * 
	 * @since	0.0.1
	 * 
	 * @param	string	$data	the data to be unserialized
	 * 
	 * @return	mixeed	$data	the unserialized data
	 */
	public static function maybe_unserialize( $data ) {
		$data = Hooks::apply( 'maybe_unserialize_raw', $data );
		if ( self::is_serialized( $data ) ) {
			$data = unserialize( trim( $data ) );
		}
		$data = Hooks::apply( 'maybe_unserialize', $data );
		return $data;
	}

	/**
	 * Reference: https://developer.wordpress.org/reference/functions/is_serialized/
	 * Just stripped of the strict part
	 */
	public static function is_serialized( $data ) {
		if ( ! is_string( $data ) ) {
			return false;
		}

		$data = trim( $data );
		if ( 'N;' === $data ) {
			return true;
		}

		if ( strlen( $data ) < 4 ) {
			return false;
		}

		if ( ':' !== $data[1] ) {
			return false;
		}
		
		$semicolon = strpos( $data, ';' );
		$brace     = strpos( $data, '}' );

		if ( false === $semicolon && false === $brace ) {
			return false;
		}

		if ( false !== $semicolon && $semicolon < 3 ) {
			return false;
		}

		if ( false !== $brace && $brace < 4 ) {
			return false;
		}

		$token = $data[0];
		switch ( $token ) {
			case 's':
				if ( ! str_contains( $data, '"' ) ) {
					return false;
				}
			case 'a':
			case 'O':
			case 'E':
				return (bool) preg_match( "/^{$token}:[0-9]+:/s", $data );
			case 'b':
			case 'i':
			case 'd':
				$end = '';
				return (bool) preg_match( "/^{$token}:[0-9.E+-]+;$end/", $data );
		}
		return false;
	}
}
