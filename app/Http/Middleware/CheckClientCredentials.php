<?php
/**
 * File: CheckClientCredentials.php
 * Author: Vladimir Pogarsky <hacking.memory@gmail.com>
 * Date: 2019-11-26
 * Copyright (c) 2019
 */

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Laravel\Passport\ClientRepository;
use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\ResourceServer;
use Symfony\Bridge\PsrHttpMessage\Factory\DiactorosFactory;
use Laravel\Passport\Http\Middleware\CheckClientCredentials as Middleware;

/**
 * Class CheckClientCredentials
 * @package App\Http\Middleware
 *
 * Override default Passport middleware to store "oauth_client" data in request
 * It is used to authenticate other micro-services
 */
class CheckClientCredentials extends Middleware
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * CheckClientCredentials constructor.
     * @param ResourceServer $server
     * @param ClientRepository $clientRepository
     */
    public function __construct(ResourceServer $server, ClientRepository $clientRepository)
    {
        parent::__construct($server);

        $this->clientRepository = $clientRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  mixed ...$scopes
     * @return mixed
     * @throws \Illuminate\Auth\AuthenticationException
     * @throws \Laravel\Passport\Exceptions\MissingScopeException
     */
    public function handle($request, Closure $next, ...$scopes)
    {
        $psr = (new DiactorosFactory)->createRequest($request);

        try {
            $psr = $this->server->validateAuthenticatedRequest($psr);
        } catch (OAuthServerException $e) {
            throw new AuthenticationException;
        }

        $this->validateScopes($psr, $scopes);

        // get authenticated client data
        $psrAttributes = $psr->getAttributes();

        // remember client_id for request
        $request->attributes->set('oauth_client_id', $psrAttributes['oauth_client_id']);

        // find current client in database
        $client = $this->clientRepository->find($psrAttributes['oauth_client_id']);
        if (null !== $client) {
            // if client found set user id to request parameters
            // it will be used in oauth_client auth guard to retrieve user associated with client
            $request->attributes->set('oauth_user_id', $client->user_id ?? null);
            $request->attributes->set('oauth_client', $client);
        }

        return $next($request);
    }
}
