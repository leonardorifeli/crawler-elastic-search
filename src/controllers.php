<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use App\Bundle\SilexRouteExtension;

// Set up container
$container = new ContainerBuilder();
$container->registerExtension(new SilexRouteExtension);
$loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../config/'));
$loader->load('routes.yml');

$app['container'] = $container;

$app->mount('/', include 'myApp.php');

$container->compile();

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    $page = 404 == $code ? '404.html' : '500.html';

    return new Response(json_encode(array('message' => $e->getMessage())));
});
