<?php

namespace App\Entity;

use Core\Entity\Entity;

class PostEntity extends Entity
{

    /**
     *
     * generate url to access and read the PostEntity
     *
     * @return string
     */
    public function getUrl()
    {
        return 'posts/' . $this->id;
    }

    /**
     *
     * generate a summary for the PostEntity
     * also include the link to read the entire post
     *
     * @return string
     */
    public function getExtrait()
    {

        $html = '<p>' . substr($this->contenu, 0, 150) . '...</p>';
        $html .= '<p><a href="' . $this->getUrl() . '">Lire la suite</a></p>';
        return $html;
    }

}
