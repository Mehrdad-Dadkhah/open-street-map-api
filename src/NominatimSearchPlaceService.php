<?php

namespace MehrdadDadkhah\OSM;

class NominatimSearchPlaceService extends OSMBase
{
    /** @var $requestHandler \GuzzleHttp\Client http guzzle client */
    private $requestHandler;

    /** @var string $format=[html|xml|json|jsonv2|geojson|geocodejson] */
    private $format = 'json';

    /** @var int $addressDetails=[0|1] */
    private $addressDetails = 1;

    /** @var int Include a breakdown of the address into elements */
    private $extraTags = 0;

    /** @var int Include additional information in the result if available, e.g. wikipedia link, opening hours */
    private $nameDetail = 0;

    /** @var string */
    private $language = null;

    /** @var string Limit search results to one or more countries. <countrycode> must be the ISO 3166-1alpha2 code, e.g.  gb for the United Kingdom, de for Germany */
    private $countryCode = null;

    /** @var int Limit the number of returned results */
    private $limit = 10;

    /** @var int */
    private $debug = 0;

    /** @var string */
    private $searchQuery;

    public function __construct()
    {
        $this->requestHandler = new \GuzzleHttp\Client(
            [
                'timeout' => 60,
            ]
        );
    }

    /**
     * Get the value of format
     *
     * @return string
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * Set the value of format
     *
     * @param string $format
     * @return  self
     */
    public function setFormat(string $format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * Set the value of addressDetails
     *
     * @return bool
     */
    public function enableAddressDetails(): bool
    {
        return $this->addressDetails == 1;
    }

    /**
     * Get the value of addressDetails
     *
     * @return  self
     */
    public function isEnableAddressDetails()
    {
        $this->addressDetails = 1;

        return $this;
    }

    /**
     * Get the value of extraTags
     *
     * @return bool
     */
    public function isEnableExtraTags(): bool
    {
        return $this->extraTags == 1;
    }

    /**
     * Set the value of extraTags
     *
     * @return  self
     */
    public function enableExtraTags()
    {
        $this->extraTags = 1;

        return $this;
    }

    /**
     * Get the value of nameDetail
     *
     * @return bool
     */
    public function isEnableNameDetail(): bool
    {
        return $this->nameDetail == 1;
    }

    /**
     * Set the value of nameDetail
     *
     * @return  self
     */
    public function enableNameDetail()
    {
        $this->nameDetail = 1;

        return $this;
    }

    /**
     * Get the value of language
     *
     * @return string|null
     */
    public function getLanguage(): ?string
    {
        return $this->language;
    }

    /**
     * Set the value of language
     *
     * @param string $language
     * @return  self
     */
    public function setLanguage(string $language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get the value of countryCode
     *
     * @return string|null
     */
    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    /**
     * Set the value of countryCode
     *
     * @param string $countryCode
     * @return  self
     */
    public function setCountryCode(string $countryCode)
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * Get the value of limit
     *
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * Set the value of limit
     *
     * @param int $limit
     * @return  self
     */
    public function setLimit(int $limit)
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * Get the value of debug
     *
     * @return bool
     */
    public function isDebugEnable(): bool
    {
        return $this->debug == 1;
    }

    /**
     * Set the value of debug
     *
     * @return  self
     */
    public function enableOSMDebug()
    {
        $this->debug = 1;

        return $this;
    }

    /**
     * Get the value of searchQuery
     *
     * @return string
     */
    public function getSearchQuery(): string
    {
        return $this->searchQuery;
    }

    /**
     * Set the value of searchQuery
     *
     * @param string
     * @return  self
     */
    public function setSearchQuery(string $searchQuery)
    {
        $this->searchQuery = $searchQuery;

        return $this;
    }

    /**
     * make search query params function
     *
     * @return string
     */
    private function makeQueryParams(): string
    {
        $params = [
            'format'         => $this->getFormat(),
            'addressdetails' => ($this->isEnableAddressDetails() ? 1 : 0),
            'extratags'      => ($this->isEnableExtraTags() ? 1 : 0),
            'namedetails'    => ($this->isEnableNameDetail() ? 1 : 0),
            'limit'          => $this->getLimit(),
            'q'              => $this->getSearchQuery(),
        ];

        if ($this->getLanguage() != null) {
            $params['accept-language'] = $this->getLanguage();
        }

        if ($this->getCountryCode() != null) {
            $params['countrycodes'] = $this->getCountryCode();
        }

        return http_build_query($params);
    }

    public function search()
    {
        $url = $this->getBaseUrl('nominatim') . '?' . $this->makeQueryParams();
        $res = $this->requestHandler->request('GET', $url);

        return json_decode($res->getBody());
    }
}
