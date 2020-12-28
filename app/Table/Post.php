<?php

namespace App\Table;

use Core\Table\Table;

class Post extends Table
{

    protected $table = 'articles';

    /**
     *
     * list all posts to newest to oldest
     *
     * @return array
     *
     */
    public function last()
    {
        return $this->query("
            SELECT articles.id, articles.titre, articles.chapo, articles.date
            FROM articles
            ORDER BY articles.date DESC
            ");
    }

    /**
     *
     * get all data and comments from the post with id = $id
     *
     * @param int $id
     * @return array
     */
    public function findWithCategorie($id)
    {
        return $this->query("
            SELECT articles.* , users.username as redacteur
            FROM articles
            LEFT JOIN users ON autor = users.id
            WHERE articles.id = ?", [$id], true);

    }

}
