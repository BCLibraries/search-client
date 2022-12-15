<?php

namespace BCLib\SearchClient\Services;

class IndipetaeResponse extends \BCLib\SearchClient\Response
{

    /**
     * Always returns null, because Indipetae API does not provide total count
     */
    public function getTotalCount(): ?int
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getItems(): array
    {
        return array_map(function ($item_json) {
            return new IndipetaeItem($item_json);
        }, $this->json);
    }

    /**
     * @inheritDoc
     */
    public function getWebSearchURL(string $keyword): string
    {
        return "https://indipetae.bc.edu/elasticsearch/search/index?q=$keyword";
    }
}