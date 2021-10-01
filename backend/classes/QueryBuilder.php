<?php

include 'Session.php';

class QueryBuilder {

    private $db;
    private $session;
    private $question_id;

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
        $is_admin = false;
        $password_hash = password_hash($data->password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare('INSERT INTO users VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bindParam(':first_date', $data->first_name);
        $stmt->bindParam(':last_name', $data->last_name);
        $stmt->bindParam(':email', $data->email);
        $stmt->bindParam(':$password', $password_hash);
        $stmt->bindParam(':total_score', $total_score);
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

    public function create_question($data) {

        $question = $data->question;
        //TODO display
        $display = $data->display;
        $correct = [];
        $answers = [];

        // inserts question in DB
        try {
            $stmt = $this->db->prepare('INSERT INTO questions VALUES(?, ?, ?)');
            $stmt->bindParam(':question_text', $question);
            $stmt->bindParam(':display', $display);
            //return $stmt->execute([NULL, $question]);
            $stmt->execute([NULL, $question, $display]);
            $this->question_id = $this->db->lastInsertId();
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

//
        foreach($answers as $answer) {

            try {
                $stmt = $this->db->prepare('INSERT INTO answers VALUES(?, ?, ?, ?)');
                $stmt->bindParam(':question_id', $answer['question_id']);
                $stmt->bindParam(':answer_text', $answer['answer_text']);
                $stmt->bindParam(':correct', $answer['correct']);
                $stmt->execute([NULL, $answer['question_id'],$answer['answer_text'], $answer['correct'] ]);
                $this->session->message('Question added successfully', 'success');
                return 'true';



            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
//        $this->session->message('Question added successfully', 'success');
//        redirect_to(URLROOT .'/admin/questions/index.php');
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

//    public function getAllQuestions() {
//        $sql = "SELECT * FROM questions_2 INNER JOIN answers ON questions_2.id = answers.question_id";
//        $stmt = $this->db->prepare($sql);
//        $stmt->execute();
//        return $stmt->fetchAll(PDO::FETCH_OBJ);
//    }

//    public function getAllQuestions() {
//        $sql = 'SELECT answers.id, answers.text, answers.correct, questions_2_text FROM answers ';
//        $sql .= ' INNER JOIN answers ON answers.question_id = questions_2.id;';
//        $query = $this->db->prepare($sql);
//        $query->execute();
//        return $query->fetchAll(PDO::FETCH_OBJ);
//
//    }

    public function getAllQuestions() {
        $sql = 'SELECT answers.id, answers.answer_text, answers.correct, questions_2.q_id, questions_2.question_text  ';
        $sql .= ' FROM answers INNER JOIN questions_2 ON answers.question_id = questions_2.q_id';
        $query = $this->db->prepare($sql);
        $query->execute();

        return  $query->fetchAll(PDO::FETCH_ASSOC);
//        $quiz = array();
//        $array = [
//            'first' => 1,
//            'second' => 2,
//            'third' => 1,
//        ];
  //    while($row =  $query->fetch(PDO::FETCH_ASSOC)){
//            if (!isset($quiz[$row['q_id']])) {
//                $quiz[$row['q_id']] = array(
//                    'question' => $row['question_text']
//                , 'answers' => array()
//                );
//            }
//            $quiz[$row['q_id']]['answers'][] = $row['answer_text'];
//
//
//
//      }

//                foreach($questions as $question) {
//                   echo( gettype ($question));
//                }
//            while(array_key_exists($questions['q_id'], $questions) === $questions['q_id']) {
//                echo 'dva puta';
//            }
                }


        //return $quiz;
    //    }



        //$data = array();
//        foreach ($result as $item) {
//            $key = $item['q_id']; // or $item['info_id']
//            if (!isset($data[$key])) {
//                $data[$key] = array();
//            }
//
//            $data[$key][] = $item;
//        }
//        return $data;
//        while($row = $query->fetchAll(PDO::FETCH_ASSOC)){
//            $data[$row["q_id"]]["name"] = $row["name"];
//            $data[$row["q_id"]]["logs"][$row["details_no"]] = array(
//                "log"=>$row["log"],
//                "date"=>$row["date"],
//            );
//        }








    } // query builder





