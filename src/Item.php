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

    /**
     * The item's type (e.g. Primo, Jesuit Online Bibliography, etc.)
     *
     * @var string
     */
    protected $type = '';

    public function __construct(array $item_json)
    {

        $this->json = $item_json;
    }

    abstract public function getTitle(): string;

    abstract public function getUrl(): string;

    abstract public function getType(): string;

    public function getJSON(): array
    {
        return $this->json;
    }
}