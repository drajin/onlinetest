<?php

require '../init.php';
use app\classes\User;
use app\classes\Result;

$id = $session->user_id;

$data = [
    'user' => User::find_by_id($id),
    'history' => Result::find_all_by_id($id, 'user_id'),
];

echo(json_encode($data));