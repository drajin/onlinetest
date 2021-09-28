<?php

    require_once 'init.php';

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    echo($query->login_or_register($data));


   //echo $query->register($data);
   //echo $query->login($data);


//    if(Application::$app->db->execute()) {
//        return true;
//    } else {
//        return false;
//    }

