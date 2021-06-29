* [Installation](#1install-the-package-via-composer)
* [Configure Provider](#2configure-provider)
* [Publishing the vendor](#publishing-the-vendor)


# Laravel Agora apis
This package is communicate with agora to generate tokens.

## 1.Install the package via Composer:

```php
$ composer require codiantnew/agora
```
## 2.Configure provider
If you're on Laravel 5.4 or earlier, you'll need to add and comment line on config/app.php:

```php
'providers' => array(
    Codiant\Agora\AgoraServiceProvider::class,
)
```
## 3.Publishing the vendor
```php
php artisan vendor:publish --provider="Codiant\Agora\AgoraServiceProvider"
```
