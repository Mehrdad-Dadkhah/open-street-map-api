<?php

namespace MehrdadDadkhah\OSM;

class OSMBase
{
    /** @var string base url */
    private $baseUrl = 'http: //router.project-osrm.org';

    /**
     * Get the value of baseUrl
     *
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * Set the value of baseUrl
     *
     * @return  self
     */
    public function setBaseUrl(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }
}
