<?php

namespace App;

use GuzzleHttp\Psr7\ServerRequest;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Kernel
{
    public function getRequest(): ServerRequestInterface
    {
        return ServerRequest::fromGlobals();
    }

    public function sendResponse(ResponseInterface $response) {
        if ($response->getStatusCode() === 404) {
            include_once '404.php';
            http_response_code(404);
        }

        foreach ($response->getHeaders() as $header) {
            header($header[0]);
        }

        $content = $response->getBody();

        echo $content;
    }
}