<?php

    require_once 'init.php';

    $json = file_get_contents('php://input');
    $data = json_decode($json);

   echo(json_encode($query->findUserByEmail($data)));

//    if(is_object($query->findUserByEmail($data))) {
//        echo 'used';
//    } else {
//        echo 'not';
//    }

    //var_dump($query->findUserByEmail($data));

//Object of class stdClass could not be converted to string in
// dovdi