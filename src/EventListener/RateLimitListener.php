<?php

declare(strict_types=1);

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\RateLimiter\RateLimiterFactory;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

class RateLimitListener
{
    private RateLimiterFactory $apiLimiter;

    public function __construct(RateLimiterFactory $apiLimiter)
    {
        $this->apiLimiter = $apiLimiter;
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();

        if (!str_starts_with($request->getPathInfo(), '/api')) {
            return;
        }

        $limiter = $this->apiLimiter->create($request->getClientIp());
        $limit = $limiter->consume();

        if (!$limit->isAccepted()) {
            throw new TooManyRequestsHttpException(retryAfter: $limit->getRetryAfter()?->getTimestamp(), message: 'Too many requests');
        }
    }
}
