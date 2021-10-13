<?php

namespace app\classes;
use PDO;

class Result extends QueryBuilder
{
    public string $user = '';

    //protected string $table_name = 'results';

    public function post_results($result) {

        $user = $this->find_by_id(static::$session->user_id, 'users');

        $time = null;
        $taken_at = null;
        $updated_at = null;

        $stmt = self::$db->prepare('INSERT INTO results VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bindParam(':user_id', $user->id);
        $stmt->bindParam(':points', $result->points);
        $stmt->bindParam(':number_of_correct_answ', $result->number_of_correct_answ);
        $stmt->bindParam(':user_correct_answers', $result->user_correct_answers);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':taken_at', $taken_at);
        $stmt->bindParam(':updated_at', $updated_at);

        $result = $stmt->execute([NULL, $user->id, $result->points, $result->number_of_correct_answ, $result->user_correct_answers, NULL, NULL, NULL]);
        if($result) {
            echo "success";
        } else {
            return "error";
        }
    }

    public function get_all_user_results() {
        $sql = "SELECT results.id, results.points, results.taken_at, results.number_of_correct_answ, results.user_correct_answers, results.updated_at, users.first_name, users.last_name ";
        $sql .= " FROM results INNER JOIN users ON users.id = results.user_id";
        $query = self::$db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);

    }

    public function get_results_for_user($id) {
        $sql = "SELECT * FROM results WHERE user_id = ?";
        $query = self::$db->prepare($sql);
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function validate_update_result() {

        $data = [
            'points' => '',
            'number_of_correct_answ' => '',
            'user_correct_answers' => '',
            'points_error' => '',
            'number_of_correct_answ_error' => '',
            'user_correct_answers_error' => '',

        ];

        //Check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'points' => trim($_POST['points']),
                'number_of_correct_answ' => trim($_POST['number_of_correct_answ']),
                'user_correct_answers' => trim($_POST['user_correct_answers']),
                'points_error' => '',
                'number_of_correct_answ_error' => '',
                'user_correct_answers_error' => '',
            ];

            //Validate Points
            if ($data['points'] === '') {
                $data['points_error'] = 'Score can\'t be empty';
            } elseif(!is_numeric($data['points'])) {
                $data['points_error'] = 'Points have to be a number.';
            }

            //Validate given correct answers
            if ($data['number_of_correct_answ'] === '') {
                $data['number_of_correct_answ_error'] = 'Score can\'t be empty';
            } elseif(!is_numeric($data['number_of_correct_answ'])) {
                $data['number_of_correct_answ_error'] = 'Points have to be a number.';
            }

            //Validate  user correct answers
            if ($data['user_correct_answers'] === '') {
                $data['user_correct_answers_error'] = 'Score can\'t be empty';
            } elseif(!is_numeric($data['user_correct_answers'])) {
                $data['user_correct_answers_error'] = 'Points have to be a number.';
            }



        } else {
            $data = [
                'points' => '',
                'number_of_correct_answ' => '',
                'user_correct_answers' => '',
                'password_error' => '',
                'number_of_correct_answ_error' => '',
                'user_correct_answers_error' => '',
            ];
        }
        return $data;
    }

    public function update_result($id, $result) {

        if(gettype($result) === 'array') {
            $result = (object)$result;
        }

        try {
            $stmt = self::$db->prepare("UPDATE results SET points=:points, number_of_correct_answ=:number_of_correct_answ, user_correct_answers=:user_correct_answers, updated_at=NOW() WHERE id=:id");
            $stmt->bindparam(":points",$result->points);
            $stmt->bindparam(":number_of_correct_answ",$result->number_of_correct_answ);
            $stmt->bindparam(":user_correct_answers",$result->user_correct_answers);
            $stmt->bindparam(":id",$id);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }

    }



}