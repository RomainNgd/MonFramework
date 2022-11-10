<?php


use App\Framework\Twig\TimeExtension;
use Framework\Renderer\RendererInterface;
use Framework\Renderer\TwigRendererFactory;
use Framework\Router;
use Framework\Twig\PagerFantaExtension;
use Framework\Twig\TextExtension;
use Psr\Container\ContainerInterface;

return[
    'database.host' => 'localhost',
    'database.username' =>'root2',
    'database.password' =>'secret',
    'database.name' =>'monsupersite',
    'views.path' => dirname(__DIR__) . '/views',
    'twig.extension' => [
        \DI\get(Router\RouterTwigExtension::class),
        \DI\get(PagerFantaExtension::class),
        \DI\get(TextExtension::class),
        \DI\get(TimeExtension::class)
    ],
    Router::class => \DI\autowire(),
    RendererInterface::class => \DI\factory(TwigRendererFactory::class),
    \PDO::class => function (ContainerInterface $c) {
        return new PDO(
            'mysql:host=' . $c->get('database.host') . ';dbname=' . $c->get('database.name'),
            $c->get('database.username'),
            $c->get('database.password'),
            [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]
        );
    }
];
