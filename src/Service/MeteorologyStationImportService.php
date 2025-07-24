<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\MeteorologyStationRepository;
use Doctrine\ORM\EntityManagerInterface;

readonly class MeteorologyStationImportService
{
    public function __construct(
        private MeteorologyStationProviderInterface $provider,
        private MeteorologyStationRepository $repository,
        private EntityManagerInterface $em,
    ) {
    }

    public function import(): int
    {
        $dtos = $this->provider->fetchStations();
        foreach ($dtos as $dto) {
            $this->repository->createOrUpdateFromDto($dto);
        }

        $this->em->flush();

        return count($dtos);
    }
}
