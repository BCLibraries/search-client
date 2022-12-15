<?php

namespace BCLib\SearchClient\Services;

use BCLib\SearchClient\Item;

class IndipetaeItem extends Item
{
    private $elements = [];

    public function __construct(array $item_json)
    {
        parent::__construct($item_json);
        $this->buildElementsMap();
    }

    public function getTitle(): string
    {
        return $this->elements['Dublin Core:::Title'];
    }

    public function getUrl(): string
    {
        $id = intval($this->json['id']);
        return "https://indipetae.bc.edu/items/show/$id";
    }

    public function getServiceLabel(): string
    {
        return IndipetaeService::LABEL;
    }

    private function buildElementsMap()
    {
        foreach ($this->json['element_texts'] as $text) {
            $element_set = $text['element_set']['name'];
            $element = $text['element']['name'];
            $value = $text['text'];
            $this->elements["$element_set:::$element"] = $value;
        }
    }
}