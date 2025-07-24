<?php

declare(strict_types=1);

namespace App\Security;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

class ApiKeyAuthenticator extends AbstractAuthenticator
{
    private const HEADER_NAME = 'Authorization';
    private const BEARER_PREFIX = 'Bearer ';

    public function __construct(private readonly string $apiKey)
    {
    }

    public function supports(Request $request): ?bool
    {
        return str_starts_with($request->headers->get(self::HEADER_NAME, ''), self::BEARER_PREFIX);
    }

    public function authenticate(Request $request): Passport
    {
        $header = $request->headers->get(self::HEADER_NAME, '');
        $providedKey = substr($header, strlen(self::BEARER_PREFIX));

        if ($providedKey !== $this->apiKey) {
            throw new AuthenticationException('Invalid API key');
        }

        return new SelfValidatingPassport(new UserBadge($providedKey, function (string $apiKey): UserInterface {
            return new class ($apiKey) implements UserInterface {
                public function __construct(private readonly string $apiKey)
                {
                }

                public function getUserIdentifier(): string
                {
                    return $this->apiKey;
                }
                public function getRoles(): array
                {
                    return ['ROLE_API'];
                }
                public function eraseCredentials(): void
                {
                }
                public function getPassword(): ?string
                {
                    return null;
                }
                public function getSalt(): ?string
                {
                    return null;
                }
                public function getUsername(): string
                {
                    return $this->apiKey;
                }
            };
        }));
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return new JsonResponse([
            'error' => 'Authentication Failed',
            'message' => $exception->getMessage(),
        ], Response::HTTP_UNAUTHORIZED);
    }
}
