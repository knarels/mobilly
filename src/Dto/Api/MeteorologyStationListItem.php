<?php

declare(strict_types=1);

namespace App\Dto\Api;

use App\Entity\MeteorologyStation;

final class MeteorologyStationListItem
{
    public function __construct(
        public string $stationId,
        public string $name,
    ) {
    }

    public static function fromEntity(MeteorologyStation $station): self
    {
        return new self($station->getStationId(), $station->getName());
    }
}
