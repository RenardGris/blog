<?php

namespace App\Entity;

use Core\Entity\Entity;

class PostEntity extends Entity
{

    public function getUrl()
    {
        return 'posts/' . $this->id;
    }

    public function getExtrait()
    {

        $html = '<p>' . substr($this->contenu, 0, 150) . '...</p>';
        $html .= '<p><a href="' . $this->getUrl() . '">Lire la suite</a></p>';
        return $html;
    }

}
