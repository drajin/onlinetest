<?php

//include_once 'Session.php';

namespace app\classes;
use PDO;

class QueryBuilder {

    static protected PDO $db;
    static protected Session $session;
    protected int $question_id;

    //protected string $table_name = "";

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
        //$sql = "SELECT * FROM {$this->table_name} WHERE id = ?";
        $sql = "SELECT * FROM {$table} WHERE id = ?";
        $query = self::$db->prepare($sql);
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }




    public function find_all_by_id($id, $table, $column)
    {
        $sql = "SELECT * FROM {$table} WHERE {$column} = ?";
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

    // ide u question answers
    public  function delete_by_id($id, $table, $column)
    {
        $sql = "DELETE FROM {$table} WHERE {$column} = ?";
        $query = self::$db->prepare($sql);
        $query->execute([$id]);
    }

} // query builder





