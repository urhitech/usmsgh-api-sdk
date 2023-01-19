# Urhitech SMS API SDK

The Urhitech SMS API SDK provides a suitable approach to the USMSGH API from applications written in PHP. It includes pre-defined set of classes and functions for API resource that initialize themeselves from  API responses.

The library provides other features. For Example:
1. Easy configuration path for fast setup and use
2. Helpers for pagination.

You can sign up for a USMSGH account at [usmsgh.com](https://www.usmsgh.com) now

## Prerequisites
PHP 5.6.0  and later

## Installation
Via [Composer](http://getcomposer.org/)
```
$ composer require supreme/urhitech-usmsgh
```

Via Git Bash
```
git clone https://github.com/urhitech/urhitech-smsgh-api.git
```

## Documentation
Please see [https://usmsgh.com/developer/](https://usmsgh.com/developer/) for up-to-date documentation

## Usage

### Step 1:
If you install the Urhitech SMS API SDK via Git Clone then load the Urhitech SMS PHP API class file and use namespace.

```php
require_once '/path/to/src/Usmsgh.php';
use Urhitec\Usms;
```

If you install Urhitech SMS API SDK via [Composer](http://getcomposer.org/) the Require the autoload.php file in the index.php of your project or whatever file you need to use Urhitech SMS PHP API classes.

```php
require __DIR__ . '/vendor/autoload.php';
use use Urhitec\Usms;;
```

The Urhitech SMS API SDK endpoints are RESTful, and consume and return JSON. All Http endpoints requires an API Key in the request header.

For more information on how to get an API Key visit [here](https://webapp.usmsgh.com/developers) to copy or generate new key for authorization.

## HTTP ENDPOINTS
* https://webapp.usmsgh.com/api/sms/send
* https://webapp.usmsgh.com/api/sms/{uid}
* https://webapp.usmsgh.com/api/sms
* https://webapp.usmsgh.com/api/me
* https://webapp.usmsgh.com/api/balance
* https://webapp.usmsgh.com/api/contacts
* https://webapp.usmsgh.com/api/contacts/{group_id}/show/
* https://webapp.usmsgh.com/api/contacts/{group_id}
* https://webapp.usmsgh.com/api/contacts/{group_id}/store
* https://webapp.usmsgh.com/api/contacts/{group_id}/search/{uid}
* https://webapp.usmsgh.com/api/contacts/{group_id}/update/{uid}
* https://webapp.usmsgh.com/api/contacts/{group_id}/delete/{uid}
* https://webapp.usmsgh.com/api/contacts/{group_id}/all


### Step 2:
Instantiate the Urhitech SMS PHP API
```php
$client = new Urhitec\Usms;
```

## Send SMS
```php
$api_key = "Enter Your API Key here";

$url = "https://webapp.usmsgh.com/api/sms/send";

$recipients = "233500000000,233540000000";
$message = "Hello world";
$senderid = "Enter your approved sender ID here";

$response = $client->sendSMS($url, $api_key, $senderid, $recipients, $message);
```


## Check SMS Credit Balance
```php
$api_key = "Enter Your API Key here";

$url = "https://webapp.usmsgh.com/api/balance";

$get_credit_balance = $client->check_balance($url, $api_key);
```


## View Profile
```php
$api_key = "Enter Your API Key here";

$url = "https://webapp.usmsgh.com/api/me";

$get_profile = $client->profile($url, $api_key);
```