<?php

namespace App\Table;

use Core\Table\Table;

class Post extends Table
{

    protected $table = 'articles';

    /**
     *
     * Recupere les derniers articles
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
     * Recupere un article (via son id) et sa categorie associée
     * @param $id int
     * @return \App\Entity\ArticleEntity
     *
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
