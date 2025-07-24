<?php

declare(strict_types=1);

namespace App\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ApiJsonResponse extends JsonResponse
{
    /**
     * @throws ExceptionInterface
     */
    public function __construct(
        private readonly SerializerInterface $serializer,
        mixed $data,
        int $status = 200,
        array $headers = [],
    ) {
        $json = $this->serializer->serialize($data, 'json', ['json_encode_options' => JSON_UNESCAPED_UNICODE]);
        parent::__construct($json, $status, $headers, true);
    }
}
