<?php

include_once 'Session.php';

class QueryBuilder {

    static protected $db;
    static protected $session;
    protected $question_id;

    public static function set_db_session($db, $session)
    {
        self::$db = $db;
        self::$session = $session;
    }


    public function select_all($table)
    {
        $sql = "SELECT * FROM {$table}";
        $query = self::$db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);

    }


    public function find_by_id($id, $table)
    {
        $sql = "SELECT * FROM {$table} WHERE id = ?";
        $query = self::$db->prepare($sql);
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }


    public function find_all_by_id($id, $table, $row)
    {
        $sql = "SELECT * FROM {$table} WHERE {$row} = ?";
        $query = self::$db->prepare($sql);
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }


    public  function delete($id, $table)
    {
        $sql = "DELETE FROM {$table} WHERE id = ?";
        $query = self::$db->prepare($sql);
        $query->execute([$id]);
    }

} // query builder





