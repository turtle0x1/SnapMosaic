<?php
namespace dhope0000\SnapMosaic\App;

use \DI\Container;

class RouteView
{
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function route($pathParts)
    {
        if (empty($pathParts)) {
            require __DIR__ . "/../../views/index.php";
        } elseif ($pathParts[0] == "login") {
            require __DIR__ . "/../../views/login.php";
        } elseif ($pathParts[1] == "firstRun") {
            require __DIR__ . "/../../views/firstRun.php";
        } else {
            throw new \Exception("Page Not Found", 1);
        }
        return true;
    }
}
