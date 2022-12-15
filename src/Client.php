<?php

namespace BCLib\SearchClient;

class Client
{
    /**
     * The services to search
     *
     * @var Service[]
     */
    private $services;

    /**
     * @param Service[] $services an array of search Services
     */
    public function __construct(array $services)
    {
        $this->services = $services;
    }

    /**
     * Search all services simultaneously
     *
     * @param string $keyword
     * @return Response[]
     */
    public function search(string $keyword): array
    {
        $multi_handle = curl_multi_init();

        // Build an array of curl handles for API requests.
        $handles = array_map(function (Service $service) use ($keyword) {
            return $service->getCURLHandle($keyword);
        }, $this->services);

        // Attach all the request handles to the CURL multi-handle.
        foreach ($handles as $handle) {
            curl_multi_add_handle($multi_handle, $handle);
        }

        // Execute all the queries.
        $running = null;
        do {
            curl_multi_exec($multi_handle, $running);
        } while ($running);

        // Remove the API handles from the multi handle and close it.
        foreach ($handles as $handle) {
            curl_multi_remove_handle($multi_handle, $handle);
        }
        curl_multi_close($multi_handle);

        $result = [];

        $num_services = count($this->services);
        for ($i = 0; $i < $num_services; $i++) {
            $service = $this->services[$i];
            $handle = $handles[$i];

            $json_text = curl_multi_getcontent($handle);
            $response_json = json_decode($json_text, true);
            $result[] = $service->readResponse($response_json);
        }

        return $result;
    }
}