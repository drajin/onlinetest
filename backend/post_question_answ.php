<?php

    require_once 'init.php';

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    echo($quiz->create_or_update_question($data));
    //var_dump($quiz->create_or_update_question($data));