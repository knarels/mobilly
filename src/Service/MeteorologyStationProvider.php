<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\MeteorologyStationDto;
use JsonException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MeteorologyStationProvider implements MeteorologyStationProviderInterface
{
    private const DATA_GOV_URL = 'https://data.gov.lv/dati/lv/api/action/datastore_search';
    private const RESOURCE_ID = 'c32c7afd-0d05-44fd-8b24-1de85b4bf11d';

    public function __construct(private readonly HttpClientInterface $httpClient)
    {
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function fetchStations(): array
    {
        $response = $this->httpClient->request('POST', self::DATA_GOV_URL, [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode(['resource_id' => self::RESOURCE_ID], JSON_THROW_ON_ERROR),
        ]);

        $data = $response->toArray();
        $records = $data['result']['records'] ?? [];

        return array_map([MeteorologyStationDto::class, 'fromImportArray'], $records);
    }
}
