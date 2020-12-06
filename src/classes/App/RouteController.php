<?php
namespace dhope0000\SnapMosaic\App;

use dhope0000\SnapMosaic\App\RouteApi;
use dhope0000\SnapMosaic\App\RouteView;
use dhope0000\SnapMosaic\App\RouteAssets;

class RouteController
{
    public $loginError = null;

    public function __construct(
        RouteApi $routeApi,
        RouteView $routeView,
        RouteAssets $routeAssets
    ) {
        $this->routeApi = $routeApi;
        $this->routeView = $routeView;
        $this->routeAssets = $routeAssets;
    }

    public function routeRequest($explodedPath)
    {
        if (isset($explodedPath[0]) && $explodedPath[0] == "api") {
            $this->routeApi->route($explodedPath, []);
            exit;
        }

        $routesForViewRoute = ["index", "login", "views"];

        if (!isset($explodedPath[0]) || in_array($explodedPath[0], $routesForViewRoute)) {
            $this->routeView->route($explodedPath);
        } elseif ($explodedPath[0] == "assets") {
            $this->routeAssets->route($explodedPath);
        } else {
            throw new \Exception("Dont understand the path", 1);
        }

        return true;
    }
}
