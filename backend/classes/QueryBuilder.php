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

//    public function questions_answers()
//    {
//        $sql = "SELECT questions.id, questions.question_text, answers.answer_text, answers.correct FROM answers INNER JOIN questions ON answers.question_id = questions.id";
//        $query = $this->db->prepare($sql);
//        $query->execute();
//        return $query->fetchAll(PDO::FETCH_OBJ);
//
//    }

    //ostaje
    public function select_all($table)
    {
        $sql = "SELECT * FROM {$table}";
        $query = self::$db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);

    }

    //ostaje
    public function find_by_id($id, $table)
    {
        $sql = "SELECT * FROM {$table} WHERE id = ?";
        $query = self::$db->prepare($sql);
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    //kandidat za question
    public function find_all_by_id($id, $table, $row)
    {
        $sql = "SELECT * FROM {$table} WHERE {$row} = ?";
        $query = self::$db->prepare($sql);
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }


    //ostaje
    public  function delete($id, $table)
    {
        $sql = "DELETE FROM {$table} WHERE id = ?";
        $query = self::$db->prepare($sql);
        $query->execute([$id]);
    }

    public  function delete_answers($question_id, $table)
    {
        $sql = "DELETE FROM {$table} WHERE question_id = ?";
        $query = self::$db->prepare($sql);
        $query->execute([$question_id]);
    }

    //visak ne znam
    //TODO find_by id function repeating
    public function find_by_question_id($id, $table)
    {
        $sql = "SELECT * FROM {$table} WHERE question_id = ?";
        $query = self::$db->prepare($sql);
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    //ide u login
    public function login_or_register($data) {
        $count = count(get_object_vars($data)); //checks on number of properties
        if($count > 2) {
            return $this->register($data);
        } else {
            return $this->login($data, 'users');
        }
    }

    //ide u login
    private function register($data)
    {
        $score = null;
        $time = null;
        $created_at = null;
        $updated_at = null;
        $is_admin = false;
        $password_hash = password_hash($data->password, PASSWORD_DEFAULT);

        $stmt = self::$db->prepare('INSERT INTO users VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bindParam(':first_date', $data->first_name);
        $stmt->bindParam(':last_name', $data->last_name);
        $stmt->bindParam(':email', $data->email);
        $stmt->bindParam(':$password', $password_hash);
        $stmt->bindParam(':score', $score);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->bindParam(':updated_at', $updated_at);

        $result = $stmt->execute([NULL, $data->first_name, $data->last_name, $data->email, $password_hash, $is_admin, NULL, NULL, NULL, NULL]);
            if($result) {
                echo "success";
            } else {
                return "error";
            }
        }

        //ide u login
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
                return self::$session->login($user);
            } else {
                return false;
            }

        }

        //probamo da napravimo abstract
        public function findUserByEmail($email, $table) {

            $stmt = self::$db->prepare("SELECT * FROM ".$table." WHERE email=?");
            $stmt->bindParam(':email', $email);
            $stmt->execute([$email]);
            return $stmt->fetch(PDO::FETCH_OBJ);

        }




        //user
        //TODO array or obj
        public function update_user($user, $id) {

            if(gettype($user) === 'array') {
                $user = (object)$user;
            }
            try {
                $stmt = self::$db->prepare("UPDATE users SET first_name=:first_name, last_name=:last_name, email=:email, updated_at=NOW() WHERE id=:id");
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
//                $stmt = self::$db->prepare("UPDATE users SET first_name=:?, last_name=:?, email=:?, updated_at=NOW() WHERE id=:id");
//                $stmt->bindParam( 'sssi',$user->first_name, $user->last_name, $user->email, $id);
//                $stmt->execute();
//                return true;
//            } catch(PDOException $e) {
//                echo $e->getMessage();
//                return false;
//            }
        }

    public function create_or_update_question($data) {
        if(!$data->question_id) {
           return $this->create_question($data);
        } else {
            return $this->update_question($data);
        };
    }

    private function create_question($data) {
        $question = $data->question;
        $display = $data->display;
        $correct = [];
        $answers = [];

        // inserts question in DB
        try {
            $stmt = self::$db->prepare('INSERT INTO questions VALUES(?, ?, ?)');
            $stmt->bindParam(':question_text', $question);
            $stmt->bindParam(':display', $display);
            //return $stmt->execute([NULL, $question]);
            $stmt->execute([NULL, $question, $display]);
            $this->question_id = self::$db->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }


        //extracts checkbox values
        foreach($data->correct as $key) {
            $correct[] = $key;
        }


        //makes answers array with answers, question id and correct values
        //adds answer text and question ids to array
        foreach($data->answers as $key => $answer_text) {
            $answers[] = [
                "answer_text" => $answer_text,
                "question_id" => $this->question_id,
            ];
            //adds correct answers values
            foreach($correct as $value) {
                if($key == $value) {
                    $answers[$key]['correct'] = true;
                }
                // adds correct value on false
                isset($answers[$key]['correct']) ? : $answers[$key]['correct'] = false;
            }
        }

        foreach($answers as $answer) {
            try {
                $stmt = self::$db->prepare('INSERT INTO answers VALUES(?, ?, ?, ?)');
                $stmt->bindParam(':question_id', $answer['question_id']);
                $stmt->bindParam(':answer_text', $answer['answer_text']);
                $stmt->bindParam(':correct', $answer['correct']);
                $stmt->execute([NULL, $answer['question_id'],$answer['answer_text'], $answer['correct'] ]);
                self::$session->message('Question added successfully', 'success');
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
      self::$session->message('Question added successfully', 'success');
//        redirect_to(URLROOT .'/admin/questions/index.php');


        return 'true';
    }

    private function update_question($data)
    {
        $question_id = $data->question_id;
        $question = $data->question;
        $display = $data->display;
        $correct = [];
        $answers = [];

        //update question
        try {
            $stmt = self::$db->prepare("UPDATE questions SET question_text=:question_text, display=:display WHERE id=:id");
            $stmt->bindparam(":question_text", $question);
            $stmt->bindparam(":display", $display);
            $stmt->bindparam(":id", $question_id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }


        //extracts checkbox values
        foreach($data->correct as $key) {
            $correct[] = $key;
        }

      //  return $correct;

        foreach($data->answers as $key => $answer) {
            $answers[] = [
                "id" => $answer->id,
                "question_id" => $question_id,
                "answer_text" => $answer->answer_text,
                "key" => $key,
            ];

//        makes answers array with answers, question id and correct values
//        adds answer text and question ids to array
//
//            adds correct answers values
            foreach($correct as $value) {
                if($key == $value) {
                    $answers[$key]['correct'] = true;

                }
                // adds correct value on false
                isset($answers[$key]['correct']) ? : $answers[$key]['correct'] = false;
            }
        }


        foreach($answers as $answer) {
            try {
                $stmt = self::$db->prepare("UPDATE answers SET question_id=:question_id, answer_text=:answer_text, correct=:correct WHERE id=:id");
                $stmt->bindparam(":question_id", $answer['question_id']);
                $stmt->bindparam(":answer_text", $answer['answer_text']);
                $stmt->bindparam(":correct", $answer['correct']);
                $stmt->bindparam(":id", $answer['id']);
                $stmt->execute();
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        self::$session->message('Question updated successfully', 'success');

        return 'true';

    }



//    public function getAllQuestions() {
//        $sql = "SELECT * FROM questions_2 INNER JOIN answers ON questions_2.id = answers.question_id";
//        $stmt = self::$db->prepare($sql);
//        $stmt->execute();
//        return $stmt->fetchAll(PDO::FETCH_OBJ);
//    }

//    public function getAllQuestions() {
//        $sql = 'SELECT answers.id, answers.text, answers.correct, questions_2_text FROM answers ';
//        $sql .= ' INNER JOIN answers ON answers.question_id = questions_2.id;';
//        $query = self::$db->prepare($sql);
//        $query->execute();
//        return $query->fetchAll(PDO::FETCH_OBJ);
//
//    }

//    public function getAllQuestions() {
//        $sql = 'SELECT answers.id, answers.answer_text, answers.correct, questions_2.id, questions_2.question_text  ';
//        $sql .= ' FROM answers INNER JOIN questions_2 ON answers.question_id = questions_2.id';
//        $query = self::$db->prepare($sql);
//        $query->execute();
//
//        return  $query->fetchAll(PDO::FETCH_ASSOC);
//        $quiz = array();
//        $array = [
//            'first' => 1,
//            'second' => 2,
//            'third' => 1,
//        ];
  //    while($row =  $query->fetch(PDO::FETCH_ASSOC)){
//            if (!isset($quiz[$row['id']])) {
//                $quiz[$row['id']] = array(
//                    'question' => $row['question_text']
//                , 'answers' => array()
//                );
//            }
//            $quiz[$row['id']]['answers'][] = $row['answer_text'];
//
//
//
//      }

//                foreach($questions as $question) {
//                   echo( gettype ($question));
//                }
//            while(array_key_exists($questions['id'], $questions) === $questions['id']) {
//                echo 'dva puta';
//            }
            //    }


        //return $quiz;
    //    }



        //$data = array();
//        foreach ($result as $item) {
//            $key = $item['id']; // or $item['info_id']
//            if (!isset($data[$key])) {
//                $data[$key] = array();
//            }
//
//            $data[$key][] = $item;
//        }
//        return $data;
//        while($row = $query->fetchAll(PDO::FETCH_ASSOC)){
//            $data[$row["id"]]["name"] = $row["name"];
//            $data[$row["id"]]["logs"][$row["details_no"]] = array(
//                "log"=>$row["log"],
//                "date"=>$row["date"],
//            );
//        }








    } // query builder





