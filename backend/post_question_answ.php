<?php

    require_once 'init.php';

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    echo($query->create_or_update_question($data));
    //var_dump($query->create_or_update_question($data));