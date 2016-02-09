<?php

namespace WeChat\MockApi\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AuthTokenRequired
{
    public function __invoke (ServerRequestInterface $req, ResponseInterface $res, callable $next)
    {
        $next($req, $res);
    }
}
