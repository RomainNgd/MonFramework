<?php
namespace App\Blog;

use App\Blog\Actions\AdminBlogActions;
use App\Blog\Actions\BlogActions;
use Framework\Module;
use Framework\Renderer\RendererInterface;
use Framework\Router;
use Psr\Container\ContainerInterface;

class BlogModule extends Module
{

    const DEFINITIONS = __DIR__ . '/config.php';

    const MIGRATIONS = __DIR__ . '/db/migrations';

    const SEEDS =  __DIR__ . '/db/seeds';

    private RendererInterface $renderer;

    public function __construct(ContainerInterface $container)
    {
        $container->get(RendererInterface::class)->addPath('blog', __DIR__ . '/views');
        $router = $container->get(Router::class);
        $router->get($container->get('blog.prefix'), BlogActions::class, 'blog.index');
        $router->get($container->get('blog.prefix') . '/{slug:[a-z\-0-9]+}-{id:[0-9]+}', BlogActions::class, 'blog.show');

        if($container->has('admin.prefix')) {
            $prefix = $container->get('admin.prefix');
            $router->get("$prefix/posts", AdminBlogActions::class, 'admin.blog.index');
            $router->get("$prefix/posts/{id:\d+}", AdminBlogActions::class, 'admin.blog.edit');
            $router->post("$prefix/posts/{id:\d+}", AdminBlogActions::class);
        }
    }
}
