<?php

namespace App\Table;

use Core\Table\Table;

class Comment extends Table
{

    protected $table = "commentaires";

    /**
     *
     * List all comments from the post with id = $postId
     *
     * @param $postId int
     *
     * @return array
     */
    public function lastByPost(int $postId): array
    {
        return $this->query("
        SELECT commentaires.* , users.username as redacteur
        FROM commentaires
        LEFT JOIN users ON user_id = users.id
        WHERE article_id = ? AND valide = 1
        ORDER BY id DESC", [$postId]);
    }

    /**
     *
     * List all comments waiting for validation
     *
     * @return array
     *
     */
    public function unvalidComments(): array
    {
        return $this->query("
        SELECT *
        FROM commentaires
        WHERE valide = 0
        ");
    }

}
