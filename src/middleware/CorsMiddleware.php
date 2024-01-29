<?php

namespace API_News\src\middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;


class CorsMiddleware
{
    public function __invoke(Request $request, Handler $handler):Response
    {
        $response = $handler->handle($request);

        // Configura las cabeceras CORS para permitir todas las solicitudes
        $response = $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE');

        return $response;
    }
}