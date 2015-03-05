<?php
/**
 * Created by PhpStorm.
 * User: shcheki
 * Date: 05.03.2015
 * Time: 08:49
 */

class AbstractModel {
    static protected $table;

    protected $data = [];
    public function __set($k, $v)
    {
        $this->data[$k] = $v;
    }
    public function __get($k)
    {
        return $this->data[$k];
    }

    public static function findAll()
    {
        $class = get_called_class();
        $sql = 'SELECT * FROM '. static::$table;
        $db = new DB();
        $db->setClassName($class);
        return $db->query($sql);
    }

    public static function findOneByPk($id)
    {
        $class = get_called_class();
        $sql = 'SELECT * FROM '. static::$table . ' WHERE id=:id';
        $db = new DB();
        $db->setClassName($class);
        return $db->query($sql, [':id' => $id])[0];
    }
    public static function findByColumn($column, $value)
    {
        $class = get_called_class();
        $sql = ' SELECT '. $column . ' FROM '. static::$table . ' WHERE value=:value';
        $db = new DB();
        $db->setClassName($class);
        return $db->query($sql, [ $column, ':value' => $value]);
    }
    public function insert()
    {
        $cols = array_keys($this->data);
        $data = [];
        foreach ($cols as $col) {
            $data[':' . $col] = $this->data[$col];
        }
        $sql = 'INSERT INTO ' . static::$table . '
        (' . implode(',',$cols) . ')
        VALUES
        (' . implode(',', array_keys($data)). ')
        ';
        $db =new DB();
        $db->execute($sql, $data);
    }
    public function update($col, $id, $newname)
    {
        $data = [];
        $sql = ' UPDATE ' . static::$table . ' SET ' . $col = $newname . ' WHERE id=:id';
        $db =new DB();
        $db->execute($sql, [$col, ':id' => $id, $newname]);
    }
    public function delete($id)
    {
        $class = get_called_class();
        $sql = ' DELETE FROM ' . static::$table . ' WHERE id=:id';
        $db = new DB();
        $db->setClassName($class);
        return $db->execute($sql, [':id'=> $id]);

    }
}