<?php

include_once 'Session.php';

class Result extends QueryBuilder
{

    public function get_results($points) {


        $user = $this->find_by_id(self::$session->user_id, 'users');

        $time = null;
        $taken_at = null;
        $updated_at = null;

        $stmt = self::$db->prepare('INSERT INTO results VALUES(?, ?, ?, ?, ?, ?)');
        $stmt->bindParam(':user_id', $user->id);
        $stmt->bindParam(':points', $points);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':taken_at', $taken_at);
        $stmt->bindParam(':updated_at', $updated_at);

        $result = $stmt->execute([NULL, $user->id, $points, NULL, NULL, NULL]);
        if($result) {
            echo "success";
        } else {
            return "error";
        }

    }

}