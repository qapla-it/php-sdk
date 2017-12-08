# QAPLA' API for PHP

This repository contains the PHP SDK that make your PHP app consume the Qapla' API.

## Setup

QAPLA' PHP SDK can be installed:

```sh
git clone https://github.com/qapla-it/php-sdk.git
```

## Example

```php
$conf = [
    'auth' => '{your-auth-key}'
];

$api = new Qapla\Qapla($config);

$couriers = $api->get('/1.1/getCouriers/');


```

## License

For more information, please see the [license file](https://github.com/qapla-it/php-sdk/blob/master/LICENSE).
