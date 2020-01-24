![Cover](/.github/images/cover.png)

# Firstclasspostcodes
The Firstclasspostcodes PHP library provides convenient access to the Firstclasspostcodes API from applications written in the PHP language. It includes pre-defined methods and helpers to help you easily integrate the library into any application.

The library also provides other features. For example:

* Easy configuration path for fast setup and use.
* Helpers for listing and formatting addresses.
* Built-in methods for easily interacting with the Firstclasspostcodes API.

## Documentation
See [PHP API docs](https://docs.firstclasspostcodes.com/php/getting-started) for detailed usage and examples.

## Installation

You can install the bindings via [Composer](http://getcomposer.org/). Run the following command:

```bash
composer require firstclasspostcodes/firstclasspostcodes
```

To use the bindings, use Composer's [autoload](https://getcomposer.org/doc/01-basic-usage.md#autoloading):

```php
require_once('vendor/autoload.php');
```

### Manual Installation

If you do not wish to use Composer, you can download the [latest release](https://github.com/firstclasspostcodes/firstclasspostcodes-php/releases). Then, to use the bindings, include the `init.php` file.

```php
require_once('/path/to/firstclasspostcodes-php/init.php');
```

## Requirements

PHP 5.6.0 and later.

## Usage
The library needs to be configured with your API key, which is available on the [dashboard](https://dashboard.firstclasspostcodes.com).

```php
$API_KEY = getenv('API_KEY');

$client = new \Firstclasspostcodes\Client(['apiKey' => $API_KEY ]);

$data = $client->getPostcode('AB30 1FR');

echo json_encode($data, JSON_PRETTY_PRINT);
```

## Configuration
The library can be configured with several options depending on the requirements of your setup:

```php
$client = new \Firstclasspostcodes\Client([
  # The API Key to be used when sending requests to the 
  # Firstclasspostcodes API
  'apiKey' => '3454tyrgdfsew23',

  # The host to send API requests to. This is typically changed
  # to use the mock service for testing purposes
  'host' => "api.firstclasspostcodes.com",

  # The default content type is json, but can be changed to "geo+json"
  # to return responses as GeoJSON content type
  'content' => "json",

  # Typically, always HTTPS, but useful to change for testing
  # purposes
  'protocol' => "https",

  # The base path is "/data", but useful to change for testing
  # purposes
  'basePath' => "/data",

  # The default request timeout for the library.
  'timeout'=> 30,
)
```

## Events
You can subscribe to events using an initialized client, passing a function as a handler:

```php
$client = new \Firstclasspostcodes\Client(['apiKey' => 'dea24tgf' ]);

$client->on('request', function ($request) {
  echo json_encode($request, JSON_PRETTY_PRINT);
});
```

| Event name | Description |
|:-----|:-----|
| `request` | Triggered before a request is sent. The request object to be sent is passed to the event handler. |
| `response` | Triggered with the parsed JSON response body upon a successful request. |
| `error` | Triggered with a client error when the request fails. |
| `operation:{name}` | Triggered by an operation with the parameter object. |

**Note:** `{name}` is replaced with the operation name of the method, as defined inside the OpenAPI specification.

## Integration / Testing
We provide a mock service of our API as a docker container [available here](https://github.com/firstclasspostcodes/firstclasspostcodes-mock). Once the container is running, the library can be easily configured to use it:

```php
$MOCK_API_KEY = "111111111111";

$API_URL = getenv('MOCK_API_URL');

$uri = parse_url($API_URL);

$client = new \Firstclasspostcodes\Client([
  'apiKey' => $MOCK_API_KEY,
  'protocol' => $uri['scheme'],
  'host' => $uri['host'],
  'basePath' => $uri['path'],
]);

$client->getPostcode('AB30 1FR');
```
