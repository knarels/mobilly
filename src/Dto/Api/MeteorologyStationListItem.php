<?php

declare(strict_types=1);

namespace App\Dto\Api;

use App\Entity\MeteorologyStation;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'MeteorologyStationListItem',
    properties: [
        new OA\Property(property: 'stationId', type: 'string', example: 'V0200'),
        new OA\Property(property: 'name', type: 'string', example: 'Vičaki'),
    ],
    type: 'object'
)]
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
