<?php

    require_once 'init.php';

    $json = file_get_contents('php://input');
    $data = json_decode($json);


   if(is_object($query->findUserByEmail($data, 'users'))) {
       echo 'false';
   } else {
       echo 'true';
   }

//var_dump($query->findUserByEmail($data, 'users'));

