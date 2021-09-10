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

    public function find_by_id($id, $table)
    {
        $sql = "SELECT * FROM {$table} WHERE id = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);


    }

    public  function delete($id, $table)
    {
        $sql = "DELETE FROM {$table} WHERE id = ?";
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

        $stmt = $this->db->prepare('INSERT INTO users VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bindParam(':first_date', $data->first_name);
        $stmt->bindParam(':last_name', $data->last_name);
        $stmt->bindParam(':email', $data->email);
        $stmt->bindParam(':$password', $password_hash);
        $stmt->bindParam(':total_score', $total_score);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->bindParam(':updated_at', $updated_at);

        $result = $stmt->execute([NULL, $data->first_name, $data->last_name, $data->email, $password_hash, NULL, NULL, NULL, NULL]);
            if($result) {
                echo "success";
            } else {
                return "error";
            }
        }


        public function findUserByEmail($email, $table) {

            $stmt = $this->db->prepare("SELECT * FROM ".$table." WHERE email=?");
            $stmt->bindParam(':email', $email);
            $stmt->execute([$email]);
            return $stmt->fetch(PDO::FETCH_OBJ);

        }

        public function login($data, $table)
        {
            //changes array in obj
            if(gettype($data) === 'array') {
                $data = (object)$data;
            }

            // checks if user or admin exists
            $user = $this->findUserByEmail($data->email, $table);
            if(!$user) {
                return false;
            }

            $hashedPassword = $user->password;
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
                return $this->login($data, 'users');
            }
        }


        //TODO array or obj
        public function update_user($user, $id) {

            if(gettype($user) === 'array') {
                $user = (object)$user;
            }
            try {
                $stmt = $this->db->prepare("UPDATE users SET first_name=:first_name, last_name=:last_name, email=:email, updated_at=NOW() WHERE id=:id");
                $stmt->bindparam(":first_name",$user->first_name);
                $stmt->bindparam(":last_name",$user->last_name);
                $stmt->bindparam(":email",$user->email);
                $stmt->bindparam(":id",$id);
                $stmt->execute();
                return true;
        } catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }
//            try {
//                $stmt = $this->db->prepare("UPDATE users SET first_name=:?, last_name=:?, email=:?, updated_at=NOW() WHERE id=:id");
//                $stmt->bindParam( 'sssi',$user->first_name, $user->last_name, $user->email, $id);
//                $stmt->execute();
//                return true;
//            } catch(PDOException $e) {
//                echo $e->getMessage();
//                return false;
//            }
        }

    public function create_question($question) {

        if (gettype($question) === 'array') {
            $question = (object)$question;
        }
        try {
            $stmt = $this->db->prepare('INSERT INTO questions VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
            $stmt->bindParam(':question_text', $question->question_text);
            $stmt->bindParam(':answer_1', $question->answer_1);
            $stmt->bindParam(':answer_2', $question->answer_2);
            $stmt->bindParam(':answer_3', $question->answer_3);
            $stmt->bindParam(':answer_4', $question->answer_4);
            $stmt->bindParam(':correct_answer', $question->correct_answer);
            $stmt->bindParam(':points', $question->points);

        return $stmt->execute([NULL, $question->question_text, $question->answer_1, $question->answer_2, $question->answer_3, $question->answer_4, $question->correct_answer, $question->points]);

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function update_question($question, $id)
    {
        if (gettype($question) === 'array') {
            $question = (object)$question;
        }
        try {
            $stmt = $this->db->prepare("UPDATE questions SET question_text=:question_text, answer_1=:answer_1, answer_2=:answer_2, answer_3=:answer_3, answer_4=:answer_4, correct_answer=:correct_answer, points=:points WHERE id=:id");
            $stmt->bindparam(":question_text", $question->question_text);
            $stmt->bindparam(":answer_1", $question->answer_1);
            $stmt->bindparam(":answer_2", $question->answer_2);
            $stmt->bindparam(":answer_3", $question->answer_3);
            $stmt->bindparam(":answer_4", $question->answer_4);
            $stmt->bindparam(":correct_answer", $question->correct_answer);
            $stmt->bindparam(":points", $question->points);
            $stmt->bindparam(":id", $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }




    } // query builder





