<?php

require dirname(__DIR__).'/vendor/autoload.php';

use App\Kernel;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\HttpFoundation\Request;

(new Dotenv())->bootEnv(dirname(__DIR__).'/.env');

$debug = $_SERVER['APP_DEBUG'];
$environment = $_SERVER['APP_ENV'];

if ($debug)
{
    Debug::enable();
}

$request = Request::createFromGlobals();
$kernel = new Kernel($debug, $environment);
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);

