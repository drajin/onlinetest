<?php

require '../init.php';

$id = $session->user_id;

$data = [
    'user' => $query->find_by_id($id, 'users'),
    'history' => $query->find_all_by_id($id, 'results', 'user_id'),
];

echo(json_encode($data));