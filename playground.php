<?php

function ppp( $pee ) {
	print '<pre>';
	print_r( $pee );
	print '</pre>';
}

require_once 'index.php';


$results = DB::get_results( 'SELECT * FROM options' );
ppp($results);
