<?php

namespace MehrdadDadkhah\OSM;

class OSMBase
{
    /** @var string[] base url */
    private $baseUrl = [
        'osm'       => 'http://router.project-osrm.org',
        'nominatim' => 'https://nominatim.openstreetmap.org',
    ];

    /**
     * Get the value of baseUrl
     *
     * @param string $servinceName
     * @return string
     */
    public function getBaseUrl(string $servinceName = 'osm'): string
    {
        return $this->baseUrl[strtolower($servinceName)];
    }

    /**
     * Set the value of baseUrl
     *
     * @param string $baseUrl
     * @param string $servinceName
     * @return self
     */
    public function setBaseUrl(string $baseUrl, string $servinceName = 'osm'): self
    {
        $this->baseUrl[strtolower($servinceName)] = $baseUrl;

        return $this;
    }
}
