<?php

namespace Core\Table;

use Core\Database\Database;

/**
 * Class Table
 * Manage all the \Table Class from App
 * Contains generals functions used by all the Table Class from app
 * Theses functions can make CRUD with the Database
 *
 */
class Table
{

    /**
     * @var string
     */
    protected $table;
    /**
     * @var Database
     */
    protected $db;

    /**
     * Table constructor.
     * use a factory to define the $table property according to the calling \table class
     *
     * @param Database $db
     */
    public function __construct(Database $db)
    {

        $this->db = $db;

        if ($this->table === null) {
            $parts = explode('\\', get_class($this));
            $className = end($parts);
            $this->table = strtolower($className) . 's';
        }

    }

    /**
     *
     * Define if the PDO statement is a query or prepared
     * if $attributes != null, make a prepared statement
     * Then, generate the statement with PDO in \Database\MysqlDb
     *
     * @param string $statement
     * @param null|array $attributes
     * @param bool $one
     * @return mixed
     */
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

    /**
     *
     * select all data from the calling \Table class
     *
     * @return mixed
     */
    public function all()
    {
        return $this->query("SELECT * FROM $this->table ");
    }

    /**
     *
     * Find all data from database of the specified $id
     * according to the calling \Table class
     *
     * @param int $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->query("SELECT * FROM {$this->table} WHERE id = ?", [$id], true);
    }

    /**
     *
     * generate an update statement
     *
     * @param int $id
     * @param array $params
     * @return mixed
     */
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

    /**
     *
     * Return a $key => $value array according to the $records
     * if $records is undefined, get all values in database of the calling Table class
     * (used to bind data in a select input)
     *
     * @param string $key
     * @param string $value
     * @param array $records
     * @return array
     */
    public function objList($key, $value, $records = [])
    {
        $records === [] ? $records = $this->all() : null;
        $result = [];
        foreach ($records as $v) {
            $result[$v->$key] = $v->$value;
        }
        return $result;

    }

    /**
     *
     * generate an insert query
     *
     * @param array $params
     * @return mixed
     */
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

    /**
     *
     * generate a delete query
     *
     * @param int $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->query("DELETE FROM {$this->table} WHERE id = ?", [$id], true);
    }

}
