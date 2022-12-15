<?php

namespace BCLib\SearchClient;

abstract class Item
{
    /**
     * The array derived from the item JSON
     *
     * @var array
     */
    protected $json;

    public function __construct(array $item_json)
    {

        $this->json = $item_json;
    }

    /**
     * Get the title of the item
     *
     * @return string
     */
    abstract public function getTitle(): string;

    /**
     * Get a URL to link to the item on the Web
     *
     * @return string
     */
    abstract public function getUrl(): string;

    /**
     * Get the item's type (e.g. "jesuit-online-bibliography")
     *
     * @return string
     */
    abstract public function getServiceLabel(): string;

    /**
     * Get the raw JSON for the item
     *
     * @return array
     */
    public function getJSON(): array
    {
        return $this->json;
    }
}