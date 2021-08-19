<?php


class QueryBuilder {

    private $db;

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

        public function login($data)
        {
            //$checkPass = password_verify($data->password, $password); //returns true or false
            $sql = $this->db->prepare("SELECT * FROM users WHERE email=?");
            $sql->bindParam(':email', $data->email);
            $sql->execute([$data->email]);

            $row = $sql->fetch(PDO::FETCH_OBJ);

            $hashedPassword = $row->password;

            if (password_verify($hashedPassword, $data->password)) {
                return 'hoce';
            } else {
                return 'nece';
            }
            //$password = $result->fetsh_assoc()['password'];

            //dd($password);
            //$singleUser = Application::$app->db->single();

//            $hashedPassword = $singleUser->password;
//            if(password_verify($password, $hashedPassword)) {
//                return $singleUser;
//            } else {
//                return false;
//            }


        }

        public function login_or_post($data) {
            $count = count(get_object_vars($data));
            if($count > 2) {
                return $this->register($data);
            } else {
                return $this->login($data);
            }
        }



    } // query builder





