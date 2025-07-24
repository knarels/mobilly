<?php

declare(strict_types=1);

namespace App\Dto\Api;

use App\Entity\MeteorologyStation;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'MeteorologyStationDetail',
    required: ['station_id', 'name', 'latitude', 'longitude', 'geogr_1', 'geogr_2', 'elevation',],
    properties: [
        new OA\Property(property: 'stationId', description: 'Station identifier as string', type: 'string', example: 'V0200'),
        new OA\Property(property: 'name', description: 'Station name', type: 'string', example: 'Vičaki'),
        new OA\Property(property: 'wmoId', description: 'WMO ID, nullable', type: 'integer', example: 12345, nullable: true),
        new OA\Property(property: 'beginDate', description: 'Start date of station data', type: 'string', format: 'date-time', example: '2000-01-01T00:00:00Z'),
        new OA\Property(property: 'endDate', description: 'End date of station data', type: 'string', format: 'date-time', example: '2023-12-31T00:00:00Z'),
        new OA\Property(property: 'latitude', description: 'Latitude in integer format', type: 'integer', example: 573000),
        new OA\Property(property: 'longitude', description: 'Longitude in integer format', type: 'integer', example: 243000),
        new OA\Property(property: 'gauss1', description: 'Gauss coordinate 1, nullable', type: 'number', format: 'float', example: 305634.5, nullable: true),
        new OA\Property(property: 'gauss2', description: 'Gauss coordinate 2, nullable', type: 'number', format: 'float', example: 456734.3, nullable: true),
        new OA\Property(property: 'geogr1', description: 'Geographic coordinate 1', type: 'number', format: 'float', example: 57.067),
        new OA\Property(property: 'geogr2', description: 'Geographic coordinate 2', type: 'number', format: 'float', example: 24.350),
        new OA\Property(property: 'elevation', description: 'Elevation', type: 'number', format: 'float', example: 95.2),
        new OA\Property(property: 'elevationPressure', description: 'Elevation pressure, nullable', type: 'number', format: 'float', example: 1012.3, nullable: true),
    ],
    type: 'object'
)]
final class MeteorologyStationDetail
{
    public function __construct(
        public string $stationId,
        public string $name,
        public ?int $wmoId,
        public ?\DateTimeInterface $beginDate,
        public ?\DateTimeInterface $endDate,
        public float $latitude,
        public float $longitude,
        public ?float $gauss1,
        public ?float $gauss2,
        public float $geogr1,
        public float $geogr2,
        public float $elevation,
        public ?float $elevationPressure,
    ) {
    }

    public static function fromEntity(MeteorologyStation $station): self
    {
        return new self(
            $station->getStationId(),
            $station->getName(),
            $station->getWmoId(),
            $station->getBeginDate(),
            $station->getEndDate(),
            $station->getLatitude(),
            $station->getLongitude(),
            $station->getGauss1(),
            $station->getGauss2(),
            $station->getGeogr1(),
            $station->getGeogr2(),
            $station->getElevation(),
            $station->getElevationPressure(),
        );
    }
}
