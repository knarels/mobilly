<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Dto\Api\MeteorologyStationDetail;
use App\Dto\Api\MeteorologyStationListItem;
use App\Entity\MeteorologyStation;
use App\Repository\MeteorologyStationRepository;
use App\Response\ApiJsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/stations', name: 'api_stations_')]
class MeteorologyStationController extends AbstractController
{
    public function __construct(
        private readonly MeteorologyStationRepository $stationRepository,
        private readonly SerializerInterface $serializer,
    ) {
    }

    /**
     * @throws ExceptionInterface
     */
    #[Route('', name: 'list', methods: ['GET'])]
    public function list(): ApiJsonResponse
    {
        $dtoList = array_map(
            static fn(MeteorologyStation $station) => MeteorologyStationListItem::fromEntity($station),
            $this->stationRepository->findAll()
        );

        return new ApiJsonResponse($this->serializer, $dtoList);
    }

    /**
     * @throws ExceptionInterface
     */
    #[Route('/{stationId}', name: 'detail', methods: ['GET'])]
    public function detail(string $stationId): ApiJsonResponse
    {
        $station = $this->stationRepository->findOneByStationId($stationId);
        if (!$station) {
            return new ApiJsonResponse($this->serializer, ['error' => 'Station not found'], 404);
        }

        return new ApiJsonResponse($this->serializer, MeteorologyStationDetail::fromEntity($station));
    }
}
