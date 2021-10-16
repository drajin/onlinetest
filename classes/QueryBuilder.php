<?php


namespace app\classes;
use PDO;

class QueryBuilder {

    static protected PDO $db;
    static protected Session $session;
    protected int $question_id;

    protected static string $table_name = "";

    public static function set_db_session($db, $session)
    {
        self::$db = $db;
        self::$session = $session;
    }

    public static function select_all()
    {
        $sql = "SELECT * FROM ".static::$table_name. "";
        $query = self::$db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);

    }

    public static function find_by_id($id)
    {
        $sql = "SELECT * FROM ".static::$table_name." WHERE id = ?";
        $query = self::$db->prepare($sql);
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }




    public static function find_all_by_id($id, $column)
    {
        $sql = "SELECT * FROM ".static::$table_name." WHERE {$column} = ?";
        $query = self::$db->prepare($sql);
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }


    public static function delete($id)
    {
        $sql = "DELETE FROM ".static::$table_name." WHERE id = ?";
        $query = self::$db->prepare($sql);
        $query->execute([$id]);
    }

    public static function delete_by_id($id, $column)
    {
        $sql = "DELETE FROM ".static::$table_name." WHERE {$column} = ?";
        $query = self::$db->prepare($sql);
        $query->execute([$id]);
    }

}





