<?php

use Exploit\Container;
use Symfony\Component\HttpFoundation\Request;

require __DIR__ . '/../vendor/autoload.php';

$container = new Container();

$request = Request::createFromGlobals();

$controller = $container->postController();
$response = $controller->index($request);

$response->send();
