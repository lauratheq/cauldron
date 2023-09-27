<?php

class Hook {
	/**
	 * The unique id of the hook
	 * 
	 * @since	0.0.1
	 * 
	 * @var		string
	 */
	public string $id;

	/**
	 * The name of the hook
	 * 
	 * @since	0.0.1
	 * 
	 * @var		string
	 */
	public string $name;

	/**
	 * The callback of the hook
	 * 
	 * @since	0.0.1
	 * 
	 * @var		string
	 */
	public string $callback;

	/**
	 * The priority of the hook
	 * 
	 * @since	0.0.1
	 * 
	 * @var		int
	 */
	public int $priority;

	/**
	 * Constructs the object
	 * 
	 * @since	0.0.1
	 * 
	 * @param	string	$id			the unique id of the hook
	 * @param	string	$name		the name of the hook
	 * @param	string	$callback	the callback of the hook
	 * @param	int		$priority	the priority of the hook, default = 10
	 * 
	 * @return	void
	 */
	public function __construct( $id, $name, $callback, $priority = 10 ) {
		$this->id = $id;
		$this->name = $name;
		$this->callback = $callback;
		$this->priority = $priority;
	}
}
