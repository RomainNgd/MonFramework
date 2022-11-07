<?php

namespace Framework\Renderer;

interface RendererInterface
{
    /**
     * Ajouter un chemin pour charger les vues
     * @param string $namespace
     * @param string|null $path
     * @return void
     */
    public function addPath(string $namespace, ?string $path = null) : void;

    /***
     * Permet de rendre une vue
     * Le chemin peut être précisé avec des namespace rajouté via le addPath()
     * $this->render('@blog/view');
     * $this->render('view');
     * @param string $view
     * @param array $params
     * @return string
     */
    public function render(string $view, array $params = []): string;

    /**
     * Permet de rajouter des variables globals toute les vues
     * @param string $key
     * @param $value
     * @return void
     */
    public function addGlobal(string $key, $value);
}
