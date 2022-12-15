<?php

namespace BCLib\SearchClient\Services;

use BCLib\SearchClient\Item;
use BCLib\SearchClient\SearchClientException;

class JesuitOnlineBibliographyItem extends Item
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
     * @throws SearchClientException
     */
    public function getUrl(): string
    {
        // Require integer IDs.
        $id = intval($this->json['id']);
        return "https://jesuitonlinebibliography.bc.edu/catalog/$id";
    }

    public function getServiceLabel(): string
    {
        return JesuitOnlineBibliographyService::LABEL;
    }

    public function getAuthor(): string
    {
        return $this->json['author'];
    }

    public function getFormat(): string
    {
        return $this->json['format'];
    }

    public function getYear(): string
    {
        return $this->json['year'];
    }
}