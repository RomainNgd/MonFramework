<?php


use Framework\Renderer\RendererInterface;
use Framework\Renderer\TwigRendererFactory;
use Framework\Router;

return[
    'views.path' => dirname(__DIR__) . '/views',
    'twig.extension' => [
        \DI\get(Router\RouterTwigExtension::class)
    ],
    Router::class => \DI\autowire(),
    RendererInterface::class => \DI\factory(TwigRendererFactory::class),
];
