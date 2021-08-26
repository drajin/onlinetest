<?php

    require_once 'init.php';

    $json = file_get_contents('php://input');
    $data = json_decode($json);


    echo ($query->login_or_register($data));
    //var_dump($query->login_or_post($data));

    //var_dump($data);

   //echo $query->register($data);
   //echo $query->login($data); // ovo je za login


//    if(Application::$app->db->execute()) {
//        return true;
//    } else {
//        return false;
//    }

