<?php

declare(strict_types=1);

namespace App\Dto\Api;

use App\Entity\MeteorologyStation;

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
