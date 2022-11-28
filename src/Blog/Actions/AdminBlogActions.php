<?php

namespace App\Blog\Actions;

use App\Blog\Table\PostTable;
use Framework\Actions\RouteurAwareAction;
use Framework\Renderer\RendererInterface;
use Framework\Router;
use http\Client\Request;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;

class AdminBlogActions
{
    private RendererInterface $renderer;
    private PostTable $posteTable;
    private Router $router;
    use RouteurAwareAction;

    public function __construct(RendererInterface $renderer, Router $router, PostTable $postTable)
    {
        $this->renderer = $renderer;
        $this->posteTable = $postTable;
        $this->router = $router;
    }
    public function __invoke(ServerRequestInterface $request)
    {
        if ($request->getAttribute('id')) {
            return $this->edit($request);
        } else {
            return $this->index($request);
        }
    }

    public function index(ServerRequestInterface $request): string
    {
        $params = $request->getQueryParams();
        $items = $this->posteTable->findPaginated(12, $params['p'] ?? 1);
        return $this->renderer->render('@blog/admin/index', compact('items'));
    }

    public function edit(ServerRequestInterface $request): string{
        $item = $this->posteTable->find($request->getAttribute('id'));

        if($request->getMethod() === "POST") {
            $params = array_filter($request->getParsedBody(), function ($key) {
                return in_array($key, ['name', 'content', 'slug']);
            }, ARRAY_FILTER_USE_KEY);
            $this->posteTable->update($item->id, $params);
            $this->redirect('admin.blog.index');
        }
        return $this->renderer->render('@blog/admin/edit', compact('item'));
    }
}
