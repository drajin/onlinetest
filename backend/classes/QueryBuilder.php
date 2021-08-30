<?php

include 'Session.php';

class QueryBuilder {

    private $db;
    private $session;

    public function __construct($db, $session)
    {
        $this->db = $db;
        $this->session = $session;
    }

    public function select_all($table)
    {
        $sql = "SELECT * FROM {$table}";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);

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
        $total_score = null;
        $time = null;
        $created_at = null;
        $updated_at = null;
        $password_hash = password_hash($data->password, PASSWORD_DEFAULT);

        $sql = $this->db->prepare('INSERT INTO users VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $sql->bindParam(':first_date', $data->first_name);
        $sql->bindParam(':last_name', $data->last_name);
        $sql->bindParam(':email', $data->email);
        $sql->bindParam(':$password', $password_hash);
        $sql->bindParam(':total_score', $total_score);
        $sql->bindParam(':time', $time);
        $sql->bindParam(':created_at', $created_at);
        $sql->bindParam(':updated_at', $updated_at);

        $result = $sql->execute([NULL, $data->first_name, $data->last_name, $data->email, $password_hash, NULL, NULL, NULL, NULL]);
            if($result) {
                echo "success";
            } else {
                return "error";
            }
        }

        public function findUserByEmail($email) {

            $sql = $this->db->prepare("SELECT * FROM users WHERE email=?");
            $sql->bindParam(':email', $email);
            $sql->execute([$email]);
            return $sql->fetch(PDO::FETCH_OBJ);

        }

        public function login($data)
        {
            // checks if user exists
            $user = $this->findUserByEmail($data->email); //returns in assoc array
            if(!$user) {
                return false;
            }

            $hashedPassword = $user['password'];
            // checks if passwords are the same
            if(password_verify($data->password,$hashedPassword)){
                return $this->session->login($user);
            } else {
                return false;
            }

        }

        public function login_or_register($data) {
            $count = count(get_object_vars($data)); //checks on number of properties
            if($count > 2) {
                return $this->register($data);
            } else {
                return $this->login($data);
            }
        }





    } // query builder




