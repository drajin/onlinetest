<?php

include_once '../../init.php';


if($session->is_logged_in() === 'false') {
    redirect_to(URLROOT . '/admin/login.php');
}


$id = $_GET['id'];

//checks if id exists
$user = $query->find_by_id($id, 'users');
$results = $query->find_all_by_id($id, 'results', 'user_id');

if($user === false) {
    redirect_to(URLROOT . '/admin/login.php');
}

$query->delete($id, 'users');
foreach($results as $result) {
    $quiz->delete_by_id($result->user_id, 'results', 'user_id');
}


$session->message('User deleted', 'success');
redirect_to(URLROOT . '/admin/users/index.php');








