# Hooks

Hooks are a possiblity for a user to "hook" into different entry points in the code and execute their callback function. The hooks can be prioritized whereas the lowest priority will be executed first.

## exec

You can place an executeable hook at any place in the code. All registered callback functions will be executed. If there is no callback function registered to this hook it does nothing. Also nothing will be returned.

```php
Hooks::exec( 'my_hook_function' );
```

## apply

The apply function works like the exec function but adds return values and arguments to the callback function. With that you can manipulate variables.

```php
$arguments = [
	'foo' = true,
	'bar' = true
];
$default_variable = "This is my default";
$default_variable = Hooks::apply( 'my_apply_hook_function', $default_variable, $arguments );
```

## add

If you want to register a callback function for an executeable hook you can simply address the hook and give your callback function.

```php
# This callback will be registered at priority 7
Hooks::add( 'the_hook_function', 'my_callback_function', 7 );
function my_callback_function() {
	# I can do anything here
}
```

If you want to manipulate a variable, you can use the same system, but you get different arguments to work with:

```php
# adds the callback `manipulate_my_apply_hook_function` to the hook at default priority (10)
Hooks::add( 'my_apply_hook_function', 'manipulate_my_apply_hook_function' );

function manipulate_my_apply_hook_function( $default, $arguments ) {
	# do something with $default and return it back
	$manipulated_variable = str_replace( 'is', 'was', $default );
	return $manipulated_variable;
}
```

## remove

It is possible to remove a callback from a hook. You need to know the name of the callback and the hook itself.

```php
Hooks::remove( 'my_apply_hook_function', 'manipulate_my_apply_hook_function' );
```
