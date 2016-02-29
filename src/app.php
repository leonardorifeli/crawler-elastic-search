<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\RoutingServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Symfony\Component\Translation\Loader\YamlFileLoader;

use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Pimple\Container;

$app = new Application();

$app->register(new TranslationServiceProvider(), array(
    'locale' => 'en',
    'locale_fallbacks' => array('en'),
));

$app['translator'] = $app->extend('translator', function($translator, $app) {
    $translator->addLoader('yaml', new YamlFileLoader());

    $translator->addResource('yaml', __DIR__.'/locale/en.yml', 'en');

    return $translator;
});

$app->register(new RoutingServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());
$app->register(new SessionServiceProvider());

$app['twig'] = $app->extend('twig', function ($twig, $app) {
    $twig->addFunction(new \Twig_SimpleFunction('asset', function ($asset) use ($app) {
        return $app['request_stack']->getMasterRequest()->getBasepath().'/'.$asset;
    }));
    return $twig;
});

$app->register(new DerAlex\Pimple\YamlConfigServiceProvider('../config/config.yml'));

$app->register(
new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options'    => array(
        'driver' => $app['config']['database']['driver'],
        'host'       => $app['config']['database']['host'],
        'dbname' => $app['config']['database']['database'],
        'user' => $app['config']['database']['user'],
        'password' => $app['config']['database']['password'],
        'charset'       => 'utf8',
        'driverOptions' => array(1002 => 'SET NAMES utf8',),
    ),
));

$app->register(new DoctrineOrmServiceProvider, array(
    "orm.proxies_dir" => __DIR__."../tmp/proxies",
    "orm.em.options" => array(
        "mappings" => array(
            array(
                "type" => "annotation",
                "namespace" => "App\Bundle\Crawler\Entity",
                "path" => __DIR__."App\Bundle\Crawler\Entity",
            )
        ),
    ),
));

$app['github.owner.service'] = function () use ($app) {
    return new App\Bundle\Crawler\Business\Service\GithubOwnerService($app["orm.em"]);
};

$app['github.repository.service'] = function () use ($app) {
    return new App\Bundle\Crawler\Business\Service\GithubRepositoryService($app["orm.em"], $app['github.owner.service']);
};

$app['github.sync.service'] = function () use ($app) {
    return new App\Bundle\Crawler\Business\Service\GithubSyncService($app["github.repository.service"]);
};

return $app;
