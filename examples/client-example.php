<?php

require_once __DIR__ . '/../vendor/autoload.php';

use BCLib\SearchClient\Client;
use BCLib\SearchClient\Services;

// Build the client with an array of services to search
$client = new Client([
    new Services\JesuitOnlineNecrologyService(),
    new Services\JesuitOnlineBibliographyService(),
    new Services\IndipetaeService() // The Indipetae service still has problems
]);

// We'll be searching for the keyword 'Paris'
$keyword = 'Paris';
$result = $client->search($keyword);

// Iterate through the results and show the values.
foreach ($result as $response) {
    echo "{$response->getServiceLabel()}\n";
    $items = $response->getItems();
    $count = count($items);

    echo "  retrieved $count of  {$response->getTotalCount()} results\n";
    echo "  URL is {$response->getWebSearchURL($keyword)}\n";

    // Show the items, with title, URL, and other info as needed.
    echo "  top results:\n";
    foreach($items as $item) {

        echo "    {$item->getTitle()}\n";
        echo "    {$item->getUrl()}\n";

        // Show special data depending on result type.
        if ($item->getServiceLabel() === Services\JesuitOnlineNecrologyService::LABEL) {
            echo "      {$item->getDescription()}\n";
        }

        if ($item->getServiceLabel() === Services\JesuitOnlineBibliographyService::LABEL) {
            echo "      {$item->getAuthor()}\n";
            echo "      {$item->getFormat()}\n";
            echo "      {$item->getYear()}\n";
        }
    }
    echo "\n";
}