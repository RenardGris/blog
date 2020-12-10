<?php

namespace App\Table;

use Core\Table\Table;

class Comment extends Table
{

    protected $table = "commentaires";

    /**
     *
     * Recupere les commentaires d'un article
     * @param $article_id int
     * @return array
     *
     */
    public function lastByArticle($article_id)
    {
        return $this->query("
        SELECT commentaires.* , users.username as redacteur
        FROM commentaires
        LEFT JOIN users ON user_id = users.id
        WHERE article_id = ? AND valide = 1
        ORDER BY id DESC", [$article_id]);
    }

    /**
     *
     * recupère tous les commentaires (en attente de validation)
     * @return array
     *
     */
    public function unvalideComments()
    {
        return $this->query("
        SELECT *
        FROM commentaires
        WHERE valide = 0
        ");
    }

}
