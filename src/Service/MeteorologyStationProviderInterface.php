<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\MeteorologyStationDto;

interface MeteorologyStationProviderInterface
{
    /**
     * @return MeteorologyStationDto[]
     */
    public function fetchStations(): array;
}
