<?php

require '../init.php';
use onlinetest\classes\User;
use onlinetest\classes\Result;

$id = $session->user_id;

$data = [
    'user' => User::find_by_id($id),
    'history' => Result::find_all_by_id($id, 'user_id'),
];

echo(json_encode($data));