<?php

include_once 'Session.php';

class Result extends QueryBuilder
{

    public function post_results($result) {

        $user = $this->find_by_id(self::$session->user_id, 'users');

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

    public function get_results_for_user($id) {
        $sql = "SELECT * FROM results WHERE user_id = ?";
        $query = self::$db->prepare($sql);
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }


}