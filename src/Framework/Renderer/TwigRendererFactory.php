<?php

namespace Framework\Renderer;

use DI\ContainerBuilder;
use Framework\Router\RouterTwigExtension;
use http\Env;
use Psr\Container\ContainerInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigRendererFactory
{

    public function __invoke(ContainerInterface $container): TwigRenderer
    {
        $viewPath = $container->get('views.path');
        $loader = new FilesystemLoader($viewPath);
        $twig = new Environment($loader);
        if ($container->has('twig.extension')) {
            foreach ($container->get('twig.extension') as $extension) {
                $twig->addExtension($extension);
            }
        }
        return new TwigRenderer($loader, $twig);
    }
}
