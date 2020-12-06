<?php
namespace dhope0000\SnapMosaic\App;

use \DI\Container;

class RouteApi
{
    public function __construct(
        Container $container
    ) {
        $this->container = $container;
    }

    public function route($pathParts, $headers, $returnResult = false)
    {
        if (count($pathParts) < 3) {
            throw new \Exception("Api String Not Long Enough", 1);
        }

        unset($pathParts[0]);

        end($pathParts);

        $methodkey = key($pathParts);
        $method = $pathParts[$methodkey];

        unset($pathParts[$methodkey]);

        $controllerStr = "dhope0000\\SnapMosaic\\Controllers\\" . implode($pathParts, "\\");
        if (!class_exists($controllerStr)) {
            throw new \Exception("End point not found", 1);
        } elseif (method_exists($controllerStr, $method) !== true) {
            throw new \Exception("Method point not found");
        }

        $params = $this->orderParams($_POST, $controllerStr, $method, $headers);

        $controller = $this->container->make($controllerStr);

        // TODO Pass provided arguments to controller
        $data = call_user_func_array(array($controller, $method), $params);

        if ($returnResult) {
            return $data;
        }

        //TODO So lazy
        echo json_encode($data);
    }

    public function orderParams($passedArguments, $class, $method, $headers)
    {
        $reflectedMethod = new \ReflectionMethod($class, $method);
        $paramaters = $reflectedMethod->getParameters();
        $o = [];


        foreach ($paramaters as $param) {
            $name = $param->getName();
            $hasDefault = $param->isDefaultValueAvailable();

            if ($name == "host" && !isset($passedArguments["hostId"])) {
                throw new \Exception("Missing paramater hostId", 1);
            }

            if ($hasDefault && !isset($passedArguments[$name])) {
                $o[$name] = $param->getDefaultValue();
            } elseif (!$hasDefault && !isset($passedArguments[$name])) {
                throw new \Exception("Missing Paramater $name", 1);
            } else {
                $o[$name] = $passedArguments[$name];
            }
        }
        return $o;
    }
}
