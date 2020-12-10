<?php

namespace Core\Table;

use Core\Database\Database;

class Table
{

    protected $table;
    protected $db;

    public function __construct(Database $db)
    {

        $this->db = $db;

        if ($this->table === null) {
            $parts = explode('\\', get_class($this));
            $className = end($parts);
            $this->table = $table = strtolower($className) . 's';
        }

    }

    public function query($statement, $attributes = null, $one = false)
    {

        $className = get_class($this) . 'Entity';
        $className = str_replace('Table', 'Entity', $className);

        if ($attributes) {
            return $this->db->prepare($statement, $attributes, $className, $one);
        } else {
            return $this->db->query($statement, $className, $one);
        }

    }

    public function all()
    {
        return $this->query("SELECT * FROM $this->table ");
    }

    public function find($id)
    {
        return $this->query("SELECT * FROM {$this->table} WHERE id = ?", [$id], true);
    }

    public function update($id, $params)
    {

        $reqParts = [];
        $attributes = [];
        foreach ($params as $k => $v) {
            $reqParts[] = "$k = ?";
            $attributes[] = $v;
        }
        $attributes[] = $id;

        $sqlParams = implode(', ', $reqParts);

        return $this->query("UPDATE {$this->table} SET $sqlParams WHERE id = ?", $attributes, true);
    }

    public function objList($key, $value, $records = [])
    {
        $records === [] ? $records = $this->all() : null;
        $result = [];
        foreach ($records as $v) {
            $result[$v->$key] = $v->$value;
        }
        return $result;

    }

    public function create($params)
    {

        $reqParts = [];
        $attributes = [];
        foreach ($params as $k => $v) {
            $reqParts[] = "$k = ?";
            $attributes[] = $v;
        }

        $sqlParams = implode(', ', $reqParts);

        return $this->query("INSERT INTO {$this->table} SET $sqlParams", $attributes, true);
    }

    public function delete($id)
    {
        return $this->query("DELETE FROM {$this->table} WHERE id = ?", [$id], true);
    }

}
