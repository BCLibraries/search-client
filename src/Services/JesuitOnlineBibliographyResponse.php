<?php

namespace BCLib\SearchClient\Services;

use BCLib\SearchClient\Response;

class JesuitOnlineBibliographyResponse extends Response
{

    /**
     * @inheritDoc
     */
    public function getTotalCount(): ?int
    {
        return $this->json['meta']['pages']['total_count'];
    }

    /**
     * @inheritDoc
     */
    public function getItems(): array
    {
        return array_map(function ($item_json) {
            return new JesuitOnlineBibliographyItem($item_json);
        }, $this->json['docs']);
    }

    /**
     * @inheritDoc
     */
    public function getWebSearchURL(string $keyword): string
    {
        $url_base = 'https://jesuitonlinebibliography.bc.edu/catalog';
        $url_params = [
            'utf' => '✓',
            'search_field' => 'all_fields',
            'q' => $keyword
        ];
        return $url_base . '?' . http_build_query($url_params);
    }
}