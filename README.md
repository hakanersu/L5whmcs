WHMCS API Laravel 5 Package (Development)
==========================
[![Laravel](https://img.shields.io/badge/Laravel-5.0-orange.svg?style=flat-square)](http://laravel.com)
[![Source](http://img.shields.io/badge/source-hakanersu/L5whmcs-orange.svg?style=flat-square)](https://github.com/hakanersu/L5whmcs)
[![License](http://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://tldrlegal.com/license/mit-license)

Installation
------------
Begin by installing the package through Composer. The best way to do this is through your terminal via Composer itself:

```
composer require xuma/l5whmcs
```
or you can add your composer.json require section:

```
"xuma/l5whmcs": "~1.0@dev"
```

Don't forget to update composer update.

Once this operation is complete, simply add both the service provider and facade classes to your project's config/app.php file:

#### Config File

Create **config/whmcs.php** with content:

```
    return [
        'url'=>'https://whmcsurl/includes/api.php',
        'username'=>'yourapiusername',
        'password'=>'yourapipassword',
        'user_agent'=>'Your Agent Name'
    ];
```


#### Service Provider
```
'Xuma\Whmcs\WhmcsServiceProvider',
```

#### Facade
```
'WHMCS'=> 'Xuma\Whmcs\Facades\Whmcs',
```



Examples
------------

Getting all clients.

```
WHMCS::getClients();
```

Getting single client
```
WHMCS::getClientsDetails($userIdOrEmail);
```

Getting clients products
```
WHMCS::getClientsProducts($userId)
```

Getting clients domains
```
WHMCS::getClientsDomains($userId)
```

Getting clients hashed password
```
WHMCS::getClientsPassword($userId)
```