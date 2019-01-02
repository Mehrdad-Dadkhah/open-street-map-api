<?php

namespace MehrdadDadkhah\OSM;

use MehrdadDadkhah\OSM\Types\Distance;
use MehrdadDadkhah\OSM\Types\Duration;

class OSMRouteService
{
    const BASE_API_URL = 'http://router.project-osrm.org/route/v1/driving/';

    /** @var $requestHandler \GuzzleHttp\Client http guzzle client */
    private $requestHandler;

    /** @var $coordinates string[][] of points */
    private $coordinates = [];

    /** @var $polyline string of polyline */
    private $polyline = null;

    /** @var $jsonData json data return from api */
    private $jsonData;

    public function __construct()
    {
        $this->requestHandler = new \GuzzleHttp\Client(
            [
                'timeout' => 60,
            ]
        );
    }

    /**
     * add route coordinate function
     *
     * @param float $lat
     * @param float $long
     * @return self
     */
    public function addCoordinate(float $lat, float $long): self
    {
        $this->coordinates[] = [
            'lat'  => $lat,
            'long' => $long,
        ];

        return $this;
    }

    /**
     * set route polyline function
     *
     * @param string $polyline
     * @return self
     */
    public function setPolyline(string $polyline): self
    {
        $this->polyline = $polyline;

        return $this;
    }

    /**
     * get distance of route function
     *
     * @return Distance
     */
    public function getDistance(): Distance
    {
        if (empty($this->coordinates) && is_null($this->polyline)) {
            throw new \Exception('Not enough data. you should set coordinates or polyline');
        }

        if (!empty($this->coordinates)) {
            return $this->getDistanceWithCoordinates();
        }

        return $this->getDistanceWithPolyline();
    }

    /**
     * get duration of route function
     *
     * @return Duration
     */
    public function getDuration(): Duration
    {
        if (empty($this->coordinates) && is_null($this->polyline)) {
            throw new \Exception('Not enough data. you should set coordinates or polyline');
        }

        if (!empty($this->coordinates)) {
            return $this->getDurationWithCoordinates();
        }

        return $this->getDurationWithPolyline();
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

        $this->jsonData = json_decode($res->getBody());

        return $this->jsonData;
    }

    /**
     * make coordinate param for get url function
     *
     * @return string
     */
    private function makeCoordinatesParam(): string
    {
        $fistStep = [];

        foreach ($this->coordinates as $coordinate) {
            $firstStep[] = implode(',', $coordinate);
        }

        return implode(';', $firstStep);
    }

    private function getDurationWithCoordinates(): Duration
    {
        $duration = new Duration();

        if (!empty($this->jsonData)) {
            $duration->setValue($this->jsonData->routes[0]->duration);

            return $duration;
        }

        $this->call(self::BASE_API_URL . $this->makeCoordinatesParam());

        $duration->setValue($this->jsonData->routes[0]->duration);

        return $duration;
    }

    private function getDurationWithPolyline(): Duration
    {
        $duration = new Duration();

        if (!empty($this->jsonData)) {
            $duration->setValue($this->jsonData->routes[0]->duration);

            return $duration;
        }

        $this->call(self::BASE_API_URL . 'polyline(' . $this->polyline . ')?overview=false');

        $duration->setValue($this->jsonData->routes[0]->duration);

        return $duration;
    }

    private function getDistanceWithCoordinates(): Distance
    {
        $distance = new Distance();

        if (!empty($this->jsonData)) {
            $distance->setValue($this->jsonData->routes[0]->distance);

            return $distance;
        }

        $this->call(self::BASE_API_URL . $this->makeCoordinatesParam());

        $distance->setValue($this->jsonData->routes[0]->distance);

        return $distance;

    }

    private function getDistanceWithPolyline(): Distance
    {
        $distance = new Distance();

        if (!empty($this->jsonData)) {
            $distance->setValue($this->jsonData->routes[0]->distance);

            return $distance;
        }

        $this->call(self::BASE_API_URL . 'polyline(' . $this->polyline . ')?overview=false');

        $distance->setValue($this->jsonData->routes[0]->distance);

        return $distance;

    }
}
