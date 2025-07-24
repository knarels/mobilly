<?php

declare(strict_types=1);

namespace App\Dto;

use DateTimeImmutable;
use Exception;

class MeteorologyStationDto
{
    public string $stationId;
    public string $name;
    public ?int $wmoId;
    public DateTimeImmutable $beginDate;
    public DateTimeImmutable $endDate;
    public int $latitude;
    public int $longitude;
    public ?float $gauss1;
    public ?float $gauss2;
    public float $geogr1;
    public float $geogr2;
    public float $elevation;
    public ?float $elevationPressure;

    /**
     * @throws Exception
     */
    public static function fromImportArray(array $record): self
    {
        $dto = new self();
        $dto->stationId = $record['STATION_ID'];
        $dto->name = $record['NAME'];
        $dto->wmoId = !empty(trim($record['WMO_ID'])) ? (int) $record['WMO_ID'] : null;
        $dto->beginDate = new DateTimeImmutable($record['BEGIN_DATE']);
        $dto->endDate = new DateTimeImmutable($record['END_DATE']);
        $dto->latitude = (int) $record['LATITUDE'];
        $dto->longitude = (int) $record['LONGITUDE'];
        $dto->gauss1 = !empty(trim($record['GAUSS1'])) ? (float) $record['GAUSS1'] : null;
        $dto->gauss2 = !empty(trim($record['GAUSS2'])) ? (float) $record['GAUSS2'] : null;
        $dto->geogr1 = (float) $record['GEOGR1'];
        $dto->geogr2 = (float) $record['GEOGR2'];
        $dto->elevation = (float) $record['ELEVATION'];
        $dto->elevationPressure = !empty(trim($record['ELEVATION_PRESSURE'])) ? (float) $record['ELEVATION_PRESSURE'] : null;

        return $dto;
    }
}
