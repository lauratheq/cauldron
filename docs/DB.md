# Database

Currently there is only mysqli supported.

## Configuration

Head to the config.php to set your credentials.

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'cauldron');
```

## Functions

### DB::get_instance();

To use the database object you just need to spawn an instance of it

```php
$db = DB::get_instance();
```

With that object, you can use the functions

### DB->query()



### DB->get_results()

