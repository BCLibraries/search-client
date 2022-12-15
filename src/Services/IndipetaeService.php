<?php

namespace BCLib\SearchClient\Services;

use BCLib\SearchClient\Response;
use BCLib\SearchClient\Service;

class IndipetaeService implements Service
{

    /**
     * @inheritDoc
     */
    public function getCURLHandle(string $keyword)
    {
        // Build the URL.
        $url_base = 'https://indipetae.bc.edu/api/items';
        $url_params = [
            'public' => 'true',
            'page' => '1',
            'per_page' => '10',
            'search' => $keyword
        ];
        $url = $url_base . '?' . http_build_query($url_params);

        // Build the cURL handle
        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        return $handle;
    }

    /**
     * @inheritDoc
     */
    public function readResponse(array $response_json): Response
    {
        return new IndipetaeResponse($response_json);
    }
}