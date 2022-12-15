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

    $response_class = get_class($response);

    echo "$response_class\n";
    $items = $response->getItems();
    $count = count($items);

    echo "  retrieved $count of  {$response->getTotalCount()} results\n";
    echo "  URL is {$response->getWebSearchURL($keyword)}\n";

    // Show the top three results, with title, description, and URL.
    echo "  top results:\n";
    for ($j = 0; $j < 3; $j++) {
        if (! isset($items[$j])) {
            continue;
        }
        echo "    {$items[$j]->getTitle()}\n    {$items[$j]->getUrl()}\n";

        // Show special data depending on result type.
        if ($response_class === 'BCLib\SearchClient\Implementations\JesuitOnlineNecrologyResponse') {
            echo "      {$items[$j]->getDescription()}\n";
        }

        if ($response_class === 'BCLib\SearchClient\Implementations\JesuitOnlineBibliographyResponse') {
            echo "      {$items[$j]->getAuthor()}\n";
            echo "      {$items[$j]->getFormat()}\n";
            echo "      {$items[$j]->getYear()}\n";
        }
    }

    echo "\n";
}