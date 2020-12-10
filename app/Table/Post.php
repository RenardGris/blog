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

    /**
     *
     * Recupere les derniers articles d'une categorie (via son id)
     * @param $categorie_id int
     * @return array
     *
     */
    public function lastByCategorie($categorie_id)
    {
        return $this->query("
        SELECT articles.id, articles.titre, articles.contenu, articles.date, categories.titre as categorie
        FROM articles
        LEFT JOIN categories ON categorie_id = categories.id
        WHERE articles.categorie_id = ?
        ORDER BY articles.date DESC", [$categorie_id]);
    }

}
