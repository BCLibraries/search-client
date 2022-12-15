<?php

namespace BCLib\SearchClient;

interface Service
{
    /**
     * Return the CURL handle for an API request for the given keyword
     *
     * @param string $keyword
     * @return resource
     */
    public function getCURLHandle(string $keyword);

    /**
     * Process a JSON response from the API
     *
     * @param array $response_json
     * @return Response
     */
    public function readResponse(array $response_json): Response;
}