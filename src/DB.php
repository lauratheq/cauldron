<?php

class DB {
	/**
	 * Holder for the instance object
	 * 
	 * @since	0.0.1
	 * 
	 * @var		object
	 */
	protected static $instance = null;

	/**
	 * The database object
	 * 
	 * @since	0.0.1
	 * 
	 * @var		object
	 */
	public $database;

	/**
	 * The resource object for the queries
	 * 
	 * @since	0.0.1
	 * 
	 * @var		object
	 */
	public $resource;

	/**
	 * The query string
	 * 
	 * @since	0.0.1
	 * 
	 * @var		string
	 */
	public string $query;

	/**
	 * The number of results if a SELECT query has
	 * been successful
	 * 
	 * @since	0.0.1
	 * 
	 * @var		int
	 */
	public int $num_rows = 0;

	/**
	 * The fetched results if a SELECT query has
	 * been successful
	 * 
	 * @since	0.0.1
	 * 
	 * @var		array
	 */
	public array $results = [];

	/**
	 * Connects to the database and creates the object
	 * 
	 * @since	0.0.1
	 * 
	 * @param	string	$db_host the database hostname
	 * @param	string	$db_user the database username
	 * @param	string	$db_pass the database password
	 * @param	string	$db_name the database name
	 * 
	 * @return	void
	 */
	protected function __construct( $db_host, $db_user, $db_pass, $db_name ) {

		$this->database = new mysqli( $db_host, $db_user, $db_pass, $db_name );
		if ( ! $this->database ) {
			exit( 'Database connection failed: ' . mysqli_connect_error() );
		}
	}

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
			self::$instance = new self( DB_HOST, DB_USER, DB_PASS, DB_NAME );
		}
		return self::$instance;
	}
	
	/**
	 * Performes the query
	 * 
	 * @since	0.0.1
	 * 
	 * @param	string	$query	the query string
	 * 
	 * @return void
	 */
	public function query( $query ) {
		$this->query = Hooks::apply( 'query', $query );
		$this->resource = mysqli_query( $this->database, $query );
		$this->num_rows = $this->resource->num_rows;
	}

	/**
	 * Fetches the result of a mysql query
	 * 
	 * @since	0.0.1
	 * 
	 * @param	string	$query	the query string
	 * 
	 * @return	array the results of the query
	 */
	public static function get_results( $query ) {
		$db = self::get_instance();
		
		$db->query( $query );
		if ( $db->num_rows >= 1 ) {
			while ( $row = mysqli_fetch_assoc( $db->resource ) ) {
				$db->results[] = $row;
			}
		}

		return $db->results;
	}
}
