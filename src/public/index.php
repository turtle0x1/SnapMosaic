<?php

require __DIR__ . "/../../vendor/autoload.php";

$builder = new \DI\ContainerBuilder();
$builder->useAnnotations(true);
$container = $builder->build();

$exceptionHandler = new dhope0000\SnapMosaic\App\ExceptionHandler();
$exceptionHandler->register();

$env = new Dotenv\Dotenv(__DIR__ . "/../../");
$env->load();
if (!isset($_ENV["DB_SQLITE"]) && !empty($_ENV["DB_SQLITE"])) {
    $env->required(['DB_HOST', 'DB_USER', 'DB_PASS', 'DB_NAME']);
}


$container->injectOn($exceptionHandler);

$router = $container->make("dhope0000\SnapMosaic\App\RouteController");

$path = ltrim($_SERVER['REQUEST_URI'], '/');    // Trim leading slash(es)
$explodedPath = array_filter(explode('/', $path));  // Split path on slashes

$router->routeRequest($explodedPath);
