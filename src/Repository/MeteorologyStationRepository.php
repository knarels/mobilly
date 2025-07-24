<?php

declare(strict_types=1);

namespace App\Repository;

use App\Dto\MeteorologyStationDto;
use App\Entity\MeteorologyStation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MeteorologyStation>
 */
class MeteorologyStationRepository extends ServiceEntityRepository
{
    public function __construct(private readonly EntityManagerInterface $em, ManagerRegistry $registry)
    {
        parent::__construct($registry, MeteorologyStation::class);
    }

    public function findOneByStationId(string $stationId): ?MeteorologyStation
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.stationId = :stationId')
            ->setParameter('stationId', $stationId)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function createOrUpdateFromDto(MeteorologyStationDto $dto, bool $flush = false): MeteorologyStation
    {
        $station = $this->findOneByStationId($dto->stationId);
        if (!$station) {
            $station = new MeteorologyStation();
            $station->setStationId($dto->stationId);
        }

        $station->setName($dto->name);
        $station->setWmoId($dto->wmoId);
        $station->setBeginDate($dto->beginDate);
        $station->setEndDate($dto->endDate);
        $station->setLatitude($dto->latitude);
        $station->setLongitude($dto->longitude);
        $station->setGauss1($dto->gauss1);
        $station->setGauss2($dto->gauss2);
        $station->setGeogr1($dto->geogr1);
        $station->setGeogr2($dto->geogr2);
        $station->setElevation($dto->elevation);
        $station->setElevationPressure($dto->elevationPressure);

        $this->em->persist($station);

        if ($flush) {
            $this->em->flush();
        }

        return $station;
    }
}
