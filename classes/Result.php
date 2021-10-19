<?php

namespace onlinetest\classes;
use PDO;
use onlinetest\classes\User;

class Result extends QueryBuilder
{
    public string $user = '';

    protected static string $table_name = 'results';

    public function create_result($result) {

        $user = User::find_by_id(static::$session->user_id);

        $time = null;
        $taken_at = null;
        $updated_at = null;

        $stmt = self::$db->prepare('INSERT INTO results VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bindParam(':user_id', $user->id);
        $stmt->bindParam(':points', $result->points);
        $stmt->bindParam(':correct_answ', $result->correct_answ);
        $stmt->bindParam(':correct_answ_user', $result->correct_answ_user);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':taken_at', $taken_at);
        $stmt->bindParam(':updated_at', $updated_at);

        $result = $stmt->execute([NULL, $user->id, $result->points, $result->correct_answ, $result->correct_answ_user, NULL, NULL, NULL]);
        if($result) {
            echo "success";
        } else {
            return "error";
        }
    }

    public function get_all_user_results() {
        $sql = "SELECT results.id, results.points, results.taken_at, results.correct_answ, results.correct_answ_user, results.updated_at, users.first_name, users.last_name ";
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

        $data = (object) [
            'points' => '',
            'correct_answ' => '',
            'correct_answ_user' => '',
            'points_error' => '',
            'correct_answ_error' => '',
            'correct_answ_user_error' => '',

        ];

        //Check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = (object) [
                'points' => trim($_POST['points']),
                'correct_answ' => trim($_POST['correct_answ']),
                'correct_answ_user' => trim($_POST['correct_answ_user']),
                'points_error' => '',
                'correct_answ_error' => '',
                'correct_answ_user_error' => '',
            ];

            //Validate Points
            if ($data->points === '') {
                $data->points_error = 'Score can\'t be empty';
            } elseif(!is_numeric($data->points)) {
                $data->points_error = 'Points have to be a number.';
            }

            //Validate given correct answers
            if ($data->correct_answ === '') {
                $data->correct_answ_error = 'Score can\'t be empty';
            } elseif(!is_numeric($data->correct_answ)) {
                $data->correct_answ_error = 'Points have to be a number.';
            }

            //Validate  user correct answers
            if ($data->correct_answ_user === '') {
                $data->correct_answ_user_error = 'Score can\'t be empty';
            } elseif(!is_numeric($data->correct_answ_user)) {
                $data->correct_answ_user_error = 'Points have to be a number.';
            }



        } else {
            $data = (object) [
                'points' => '',
                'correct_answ' => '',
                'correct_answ_user' => '',
                'password_error' => '',
                'correct_answ_error' => '',
                'correct_answ_user_error' => '',
            ];
        }
        return $data;
    }

    public function update_result($id, $result) {

        if(gettype($result) === 'array') {
            $result = (object)$result;
        }

        try {
            $stmt = self::$db->prepare("UPDATE results SET points=:points, correct_answ=:correct_answ, correct_answ_user=:correct_answ_user, updated_at=NOW() WHERE id=:id");
            $stmt->bindparam(":points",$result->points);
            $stmt->bindparam(":correct_answ",$result->correct_answ);
            $stmt->bindparam(":correct_answ_user",$result->correct_answ_user);
            $stmt->bindparam(":id",$id);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }

    }



}