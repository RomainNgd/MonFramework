<?php

namespace App\Blog\Table;

use App\Blog\Entity\Post;
use App\Framework\Database\PaginatedQuery;
use Pagerfanta\Pagerfanta;
use stdClass;

class PostTable
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Pagine les articles
     * @param int $perPage
     * @return Pagerfanta
     */
    public function findPaginated(int $perPage, int $currentPage): Pagerfanta
    {
        $query = new PaginatedQuery(
            $this->pdo,
            'SELECT * FROM posts ORDER BY created_at DESC',
            'SELECT COUNT(id) FROM posts',
            Post::class
        );

        return (new Pagerfanta($query))
            ->setMaxPerPage($perPage)
            ->setCurrentPage($currentPage);
    }

    /**
     * Récupère un article à partir de son id
     * @param int $id
     * @return Post
     */
    public function find(int $id): Post
    {
        $query = $this->pdo
        ->prepare('SELECT * FROM posts WHERE id = ?');
        $query->execute([$id]);
        $query->setFetchMode(\PDO::FETCH_CLASS, Post::class);
        return $query->fetch();
    }
}
