# Open Street Map API service

[![Packagist Version](https://img.shields.io/packagist/v/Mehrdad-Dadkhah/open-street-map-api.svg?style=flat-square)](https://github.com/Mehrdad-Dadkhah/open-street-map-api)

Open Street Map (OSM) service to call and get results of APIs.

Will add new services in future.

## System requirements

only with >=7.0.0

## Installation

```
composer require mehrdad-dadkhah/open-street-map-api
```

## Usage

with coordinates option:

```PHP
use MehrdadDadkhah\OSM\OSMRouteService;

$osm = new OSMRouteService;
        $osm->addCoordinate(35.6998, 51.3310)
            ->addCoordinate(35.7581, 51.5087);
        
        echo $osm->getDuration()->getWithUnit(MehrdadDadkhah\OSM\Types\Duration::MINUTE_UNIT);
        echo $osm->getDistance()->getWithUnit(MehrdadDadkhah\OSM\Types\Distance::KILOMETER_UNIT);
```

with polyline option:

```PHP
use MehrdadDadkhah\OSM\OSMRouteService;

$osm = new OSMRouteService;
        $osm->setPolyline('ofp_Ik_vpAilAyu@te@g%60E');
        
        echo $osm->getDuration()->getWithUnit(MehrdadDadkhah\OSM\Types\Duration::MINUTE_UNIT);
        echo $osm->getDistance()->getWithUnit(MehrdadDadkhah\OSM\Types\Distance::KILOMETER_UNIT);
```

## Acknowledgments

* Thanks to [osrm-backend](https://github.com/Project-OSRM/osrm-backend/blob/master/docs/http.md)

Uses:

* [guzzlehttp/guzzle](https://github.com/guzzle/guzzle)