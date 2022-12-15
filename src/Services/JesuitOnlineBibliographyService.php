<?php

namespace BCLib\SearchClient\Services;

use BCLib\SearchClient\Request;
use BCLib\SearchClient\Response;
use BCLib\SearchClient\Service;

class JesuitOnlineBibliographyService implements Service
{

    /**
     * @inheritDoc
     */
    public function getcURLHandle(string $keyword)
    {
        // Build the URL.
        $url_base = 'https://jesuitonlinebibliography.bc.edu/catalog';
        $url_params = [
            'utf' => '✓',
            'search_field' => 'all_fields',
            'format' => 'json',
            'q' => $keyword
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
        return new JesuitOnlineBibliographyResponse($response_json);
    }

    public function getLabel(): string
    {
        return 'jesuit-online-bibliography';
    }
}