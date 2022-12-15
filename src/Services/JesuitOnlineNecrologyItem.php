<?php

namespace BCLib\SearchClient\Services;

use BCLib\SearchClient\Item;
use BCLib\SearchClient\SearchClientException;

class JesuitOnlineNecrologyItem extends Item
{
    /**
     * Return the item's title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->json['title'];
    }

    /**
     * Return the URL for the item
     *
     * @return string
     */
    public function getUrl(): string
    {
        // Require integer IDs.
        $id = intval($this->json['id']);
        return "https://jesuitonlinenecrology.bc.edu/catalog/$id";
    }

    public function getServiceLabel(): string
    {
        return JesuitOnlineNecrologyService::LABEL;
    }

    /**
     * Get description of Necrology person
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->json['description'];
    }
}