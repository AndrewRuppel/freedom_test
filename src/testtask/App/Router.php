<?php

namespace App;

use App\Controllers\DataController;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Router implements RequestHandlerInterface
{
    /**
     * Routes list
     */
    private array $routes = [
        '/' => [DataController::class, 'getData'],
    ];

    public function handle(ServerRequestInterface $request): ResponseInterface {
        $method = $request->getMethod();
        $uri = $request->getUri();
        $path = $uri->getPath();

        if (!isset($this->routes[$path])) {
            return new Response(404);
        }

        $route = $this->routes[$path];

        $controller = new $route[0];
        $action = $route[1];

        $result = $controller->$action($request);
        $headers = [];

        if (is_array($result)) {
            $headers[] = 'Content-Type: application/json';
            $result = json_encode($result);
        }

        return new Response(200, $headers, $result);
    }
}