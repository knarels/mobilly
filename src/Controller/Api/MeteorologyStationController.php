<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Dto\Api\MeteorologyStationDetail;
use App\Dto\Api\MeteorologyStationListItem;
use App\Entity\MeteorologyStation;
use App\Repository\MeteorologyStationRepository;
use App\Response\ApiJsonResponse;
use OpenApi\Attributes as OA;
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
    #[OA\Get(
        path: '/api/stations',
        summary: 'Get all meteorology station IDs and names',
        tags: ['Stations'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'List of stations',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(ref: '#/components/schemas/MeteorologyStationListItem')
                )
            )
        ]
    )]
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
    #[OA\Get(
        path: '/api/stations/{stationId}',
        summary: 'Get station details by station ID',
        tags: ['Stations'],
        parameters: [
            new OA\Parameter(
                name: 'stationId',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'string')
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Station detail',
                content: new OA\JsonContent(ref: '#/components/schemas/MeteorologyStationDetail')
            ),
            new OA\Response(
                response: 404,
                description: 'Not found',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'error', type: 'string')
                    ],
                    type: 'object',
                )
            )
        ]
    )]
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
