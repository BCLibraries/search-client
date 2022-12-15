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

    // Link to search on Web.
    $search_url = $response->getWebSearchURL("paris");
    $total_count = $response->getTotalCount();
    
    // Iterate through the response items.
    foreach ($response->getItems() as $item) {
        $title = $item->getTitle();
        $item_url = $item->getUrl();
    }
}
```