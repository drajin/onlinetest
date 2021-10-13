<?php

    require_once '../init.php';

    $json = file_get_contents('php://input');
    $data = json_decode($json);


   if(is_object($user_controller->findUserByEmail($data))) {
       echo 'true';
   } else {
       echo 'false';
   }

   // var_dump(gettype($user_controller->findUserByEmail($data)));

