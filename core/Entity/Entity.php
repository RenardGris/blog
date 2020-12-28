<?php

namespace Core\Entity;

/**
 * Class Entity
 * Manage all the entity from App/Entity
 * Contains generals functions used by all the entities
 *
 */
class Entity
{

    /**
     *
     * factory used to request properties from entity
     *
     * @param mixed $key
     * @return mixed
     */
    public function __get($key)
    {
        $method = 'get' . ucfirst($key);
        $this->$key = $this->$method();
        return $this->$key;
    }

}
