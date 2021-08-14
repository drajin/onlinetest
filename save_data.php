<?php

    require_once 'init.php';

    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $query->register($data);



//    $db->query('INSERT INTO posts (user_id, title, body) VALUES (:user_id, :title, :body)');
//    $db->bind('user_id', $_SESSION['user_id']);
//    $db->bind(':title', $this->title);
//    $db->bind(':body', $this->body);
//
//
//    if(Application::$app->db->execute()) {
//        return true;
//    } else {
//        return false;
//    }

