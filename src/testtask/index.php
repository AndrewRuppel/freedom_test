<?php

require_once __DIR__ . '/vendor/autoload.php';
define('__ROOT__',  __DIR__);
define('__VIEWS__', __ROOT__ . '/App/View');

$kernel = new \App\Kernel();

$request = $kernel->getRequest();

$response = (new \App\Router())->handle($request);

$kernel->sendResponse($response);