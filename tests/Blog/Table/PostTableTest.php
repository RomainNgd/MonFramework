<?php

namespace Tests\Blog\Table;

use App\Blog\Entity\Post;
use App\Blog\Table\PostTable;
use PDO;
use PHPUnit\Framework\TestCase;

class PostTableTest extends TestCase
{
    public function testFind(){
        $pdo = new PDO('sqlite::memory', null, null, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        $postTable = new PostTable($pdo);
        $post = $postTable->find(1);
        $this->assertInstanceOf(Post::class, $post);
    }
}