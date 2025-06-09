<?php

namespace App\Service;

use Exception;
use Symfony\Component\HttpFoundation\RequestStack;

readonly class JwtCookieService
{
    public function __construct(
        private RequestStack $requestStack
    ) {}

    public function getEmailFromJwtToken(): ?string
    {
        $request = $this->requestStack->getCurrentRequest();

        if (!$request) {
            return null;
        }

        $jwtToken = $request->cookies->get('jwt_token');
        if (!$jwtToken) {
            return null;
        }

        try {
            $payload = json_decode(base64_decode(explode(".", $jwtToken)[1]), true);

            if (isset($payload['email'])) {
                return $payload['email'];
            }
        } catch (Exception $e) {
            return null;
        }

        return null;
    }
}