<?php

function ppp( $pee ) {
	print '<pre>';
	print_r( $pee );
	print '</pre>';
}

require_once 'index.php';

Options::remove( 'foobart' );
