<?php
/**
 * ESIA Gateway Client
 *
 * @author Valentin Nazarov <v.nazarov@pos-credit.ru>
 * @copyright Copyright (c) 2023, The Vanta
 */

declare(strict_types=1);

namespace Vanta\Integration\EsiaGateway\Infrastructure\HttpClient\Middleware;

use GuzzleHttp\Psr7\Utils;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Vanta\Integration\EsiaGateway\Infrastructure\HttpClient\ConfigurationClient;

final class UrlMiddleware implements Middleware
{
    public function process(Request $request, ConfigurationClient $configuration, callable $next): Response
    {
        $request = $request->withUri(
            Utils::uriFor(sprintf('%s%s', $configuration->url, $request->getUri()->__toString()))
        );

        return $next($request, $configuration);
    }
}
