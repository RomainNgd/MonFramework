<?php
namespace Tests\Blog\Actions;

use App\Blog\Actions\BlogActions;
use Framework\Renderer\RendererInterface;
use Framework\Router;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;

class BlogActionTest extends TestCase
{

    private BlogActions $action;
    private ObjectProphecy $renderer;
    private ObjectProphecy $pdo;
    private ObjectProphecy $router;

    public function setUp(): void
    {
        $this->renderer = $this->prophesize(RendererInterface::class);
        $this->renderer->render(Argument::any())->willReturn('');

        // Article
        $post = new \stdClass();
        $post->id = 9;
        $post->slug = 'demo-test';

        //PDO
        $this->pdo = $this->prophesize(\PDO::class);
        $pdoStatement = $this->prophesize(\PDOStatement::class);
        $this->pdo->prepare(Argument::any())->willReturn($pdoStatement);
        $pdoStatement->execute(Argument::any())->willReturn(null);
        $pdoStatement->fetch()->willReturn($post);
        $this->router = $this->prophesize(Router::class);
        $this->action = new BlogActions(
            $this->renderer->reveal(),
            $this->pdo->reveal(),
            $this->router->reveal()
        );
    }

    public function testShowRedirect()
    {
        $request = (new ServerRequest('GET', '/'))
            ->withAttribute('id', 9)
            ->withAttribute('slug', 'demo');
        $response = call_user_func_array($this->action, [$request]);
        $this->assertEquals(301, $response->getStatusCode());
    }
}
