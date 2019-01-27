<?php

namespace MehrdadDadkhah\OSM;

use MehrdadDadkhah\OSM\Types\Location;

class OSMLocationService extends OSMBase
{
    /** @var \GuzzleHttp\Client $requestHandler http guzzle client */
    private $requestHandler;

    /** @var string[][] $coordinates of points */
    private $coordinates = [];

    /** @var float[] point info */
    private $point;

    /** @var int zoom level */
    private $zoom = 18;

    /** @var string accept language */
    private $language = 'en';

    public function __construct()
    {
        $this->requestHandler = new \GuzzleHttp\Client(
            [
                'timeout' => 60,
            ]
        );
    }

    /**
     * set location point function
     *
     * @param float $lat
     * @param float $long
     * @return self
     */
    public function setPoint(float $lat, float $long): self
    {
        $this->point = [
            'lat' => $lat,
            'lon' => $long,
        ];

        return $this;
    }

    /**
     * return api URI function
     *
     * @return string
     */
    private function getUri(): string
    {
        return $this->getBaseUrl() . '/reverse?format=json&';
    }

    /**
     * call api url and return json object data function
     *
     * @param string $url
     * @return \stdClass
     */
    private function call(string $url): \stdClass
    {
        $res = $this->requestHandler->request('GET', $url);

        return json_decode($res->getBody());
    }

    /**
     * make coordinate param for get url function
     *
     * @return string
     */
    private function makeCoordinatesParam(): string
    {
        $firstStep[] = 'lat=' . $this->point['lat'];
        $firstStep[] = 'lon=' . $this->point['lon'];
        $firstStep[] = 'zoom=' . $this->getZoom();
        $firstStep[] = 'accept-language=' . $this->getLanguage();

        return implode('&', $firstStep);
    }

    public function reverseLocation(): Location
    {
        $location = new Location();

        $data = $this->call($this->getUri() . $this->makeCoordinatesParam());
        $location->setValue($data);

        return $location;
    }

    /**
     * Get the value of zoom
     */
    public function getZoom()
    {
        return $this->zoom;
    }

    /**
     * Set the value of zoom
     *
     * @return  self
     */
    public function setZoom($zoom)
    {
        $this->zoom = $zoom;

        return $this;
    }

    /**
     * Get the value of language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set the value of language
     *
     * @return  self
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }
}
