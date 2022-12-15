<?php

namespace BCLib\SearchClient;

abstract class Response
{
    /**
     * The array derived from the item JSON
     *
     * @var array
     */
    public $json;

    /**
     * @param array $response_json
     */
    public function __construct(array $response_json)
    {
        $this->json = $response_json;
    }

    /**
     * Get the total number of results from the search
     *
     * Returns null if the API does not return a total number of results.
     *
     * @return ?int
     */
    abstract public function getTotalCount(): ?int;

    /**
     * Return an ordered array of the items
     *
     * @return Item[]
     */
    abstract public function getItems(): array;

    /**
     * Return the URL that links to a search of the site for the given keyword
     *
     * Note that this does not return the API URL, but the URL a person visiting the site
     * would use to perform the search.
     *
     * @param string $keyword
     * @return string
     */
    abstract public function getWebSearchURL(string $keyword): string;
}