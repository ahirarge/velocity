# Velocity

Velocity is a url analyzer for Laravel 4. It saves every request information to database and you  can review log at any time.


## Installation

To install through composer, simply put the following in your `composer.json` file:

```json
{
    "require": {
        "ahir/velocity": "dev-master",
    }
}
```
After installing the package, open your Laravel config file `app/config/app.php` and add the following lines.

In the $providers array add the following service provider for this package;

```php
'Ahir\Velocity\VelocityServiceProvider',
```

Add the `Velocity` facades to the `aliases` in `app/config/app.php`:

```php
'Velocity' => 'Ahir\Velocity\Facades\Velocity',
```

## Configuration

You must run the following code on the console;

```
php artisan migrate --package=ahir/velocity
php artisan config:publish ahir/velocity
php artisan asset:publish ahir/velocity

```
The following arrangements should be made.

 `app/start/global.php`
```php 
App::before(function($request)
{
	Velocity::start();
});

App::after(function($request, $response)
{
    Velocity::stop();
});
```

`app/controllers/BaseController.php`
```php
/**
 * Construct 
 * 
 * @return null
 */
public function __construct()
{
	Velocity::handle($this);
}
```

If you don't want to tracked a URL, you must define it in the configuration file. `ban_url_array` parameter can be used for this operation.

## Analysis

You can use this URL to examine all requests; `domain.com/ahir/velocity`

## License

MIT


