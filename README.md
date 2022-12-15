Perform parallel searches of API-enabled Boston College Libraries services.

## Installation

Install with [Composer](https://getcomposer.org/):

```shell
composer require bclibraries/search-client::^1.0
```

## Usage

See the *examples* directory for a complete example.

```php
use \BCLib\SearchClient\Client;
use \BCLib\SearchClient\Services;

$services = [
    new Services\JesuitOnlineBibliographyService(),
    new Services\JesuitOnlineNecrologyService()
];

$client = new Client($services);
$responses = $client->search("paris");

foreach ($responses as $response) {
    
}
```