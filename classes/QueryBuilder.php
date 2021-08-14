<?php


class QueryBuilder {

    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function select_all($table)
    {
        $sql = "SELECT * FROM {$table}";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    public function find_by_id($table, $id)
    {
        $sql = "SELECT * FROM {$table} WHERE id = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$id]);

        $post_owner = $query->fetch(PDO::FETCH_ASSOC);
        return $post_owner;

    }

    public  function delete($id)
    {
        var_dump($id);
        $sql = "DELETE FROM posts2 WHERE id = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$id]);
    }


    public function register($data)
    {



            $password_hash = password_hash($data->password, PASSWORD_DEFAULT);
            $sql = 'INSERT INTO users VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $query = $this->db->prepare($sql);
            $query->execute([NULL, $data->first_name, $data->last_name, $data->email, $password_hash, NULL, NULL, NULL, NULL]);



//
//
//        $sql = 'INSERT INTO users VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)';
//        $query = $this->db->prepare($sql);
//        $sql->bind_param("issssisss", NULL, $data->first_name, $data->last_name, $data->email, $password_hash, NULL, NULL, NULL, NULL);
//        $query = $this->db->prepare($sql);
//        $query->execute([NULL, $data->first_name, $data->last_name, $data->email, $password_hash, NULL, NULL, NULL, NULL]);



            if($query) {
                echo "success";
            } else {
                return "error";
            }



    }




}


