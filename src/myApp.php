<?php

$myApp = $app['controllers_factory'];

foreach ($container->getExtensionConfig('routes')[0] as $name => $route) {
    $controller = $myApp->match($route['pattern'], $route['controller']);
    $controller->method($route['requirements']['_method']);
    $controller->bind($name);
}
return $myApp;
