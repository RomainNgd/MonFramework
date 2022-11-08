<?php

namespace App\Blog\Actions;

use Framework\Renderer\RendererInterface;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ServerRequestInterface;

class BlogActions
{
    private RendererInterface $renderer;

    public function __construct(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }
    public function __invoke(ServerRequestInterface $request): string
    {
        $slug = $request->getAttribute('slug');
        if ($slug) {
            return $this->show($slug);
        } else {
            return $this->index();
        }
    }

    public function index(): string
    {
        return $this->renderer->render('@blog/index');
    }

    public function show(string $slug):string
    {
        return $this->renderer->render('@blog/show', [
            'slug' => $slug
        ]);
    }
}
