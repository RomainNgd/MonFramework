<?php

namespace Framework\Renderer;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Loader\FilesystemLoader;
use Twig_Loader_Filesystem;
use Twig_Environment;

class TwigRenderer implements RendererInterface
{
    private $twig;
    private $loader;

    public function __construct(FilesystemLoader $loader, Environment $twig)
    {
        $this->loader = $loader;
        $this->twig = $twig;
    }

    /**
     * Ajouter un chemin pour charger les vues
     * @param string $namespace
     * @param string|null $path
     * @return void
     * @throws LoaderError
     */
    public function addPath(string $namespace, ?string $path = null) : void
    {
        $this->loader->addPath($path, $namespace);
    }

    /**
     * Permet de rendre une vue
     * Le chemin peut être précisé avec des namespace rajouté via le addPath()
     * $this->render('@blog/view');
     * $this->render('view');
     * @param string $view
     * @param array $params
     * @return string
     * @throws LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function render(string $view, array $params = []): string
    {
        return $this->twig->render($view . '.twig', $params);
    }

    /**
     * Permet de rajouter des variables globals toute les vues
     * @param string $key
     * @param $value
     * @return void
     */
    public function addGlobal(string $key, $value)
    {
        $this->twig->addGlobal($key, $value);
    }
}
