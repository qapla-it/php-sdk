# DEPRECATED
This repository is deprecated and no longer maintained.

# QAPLA' API for PHP

This repository contains the PHP SDK that make your PHP app consume the Qapla' API.

## Setup

QAPLA' PHP SDK can be installed:

```sh
git clone https://github.com/qapla-it/php-sdk.git
```

## Example

```php
$config = [
    'auth' => '{your-auth-key}'
];

try{
    $api = new Qapla\Qapla($config);
}
catch(Qapla\QaplaSDKException $e){
    exit($e->getMessage());
}

$couriers = $api->get('/1.1/getCouriers/');


```

## License

For more information, please see the [license file](https://github.com/qapla-it/php-sdk/blob/master/LICENSE).
