<?php
namespace App\Blog;

use App\Blog\Actions\BlogActions;
use Framework\Module;
use Framework\Renderer;
use Framework\Renderer\RendererInterface;
use Framework\Router;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class BlogModule extends Module
{

    const DEFINITIONS = __DIR__ . '/config.php';

    const MIGRATIONS = __DIR__ . '/db/migrations';

    const SEEDS =  __DIR__ . '/db/seeds';

    private RendererInterface $renderer;

    public function __construct(string $prefix, Router $router, RendererInterface $renderer)
    {
        $this->renderer= $renderer;
        $this->renderer->addPath('blog', __DIR__ . '/views');
        $router->get($prefix, BlogActions::class, 'blog.index');
        $router->get($prefix . '/{slug:[a-z\-0-9]+}-{id:[0-9]+}', BlogActions::class, 'blog.show');
    }
}
