<?php

function ppp( $pee ) {
	print '<pre>';
	print_r( $pee );
	print '</pre>';
}

require_once 'cauldron/index.php';

Hooks::add( 'this_is_my_test', 'my_test_function' );
function my_test_function() {
	echo 'Ja, ok';
}

Hooks::exec( 'this_is_my_test' );
