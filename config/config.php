<?php


use Framework\Renderer\RendererInterface;
use Framework\Renderer\TwigRendererFactory;
use Framework\Router;

return[
    'database.host' => 'localhost',
    'database.username' =>'root2',
    'database.password' =>'secret',
    'database.name' =>'monsupersite',
    'views.path' => dirname(__DIR__) . '/views',
    'twig.extension' => [
        \DI\get(Router\RouterTwigExtension::class)
    ],
    Router::class => \DI\autowire(),
    RendererInterface::class => \DI\factory(TwigRendererFactory::class),
];
