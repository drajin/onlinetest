<?php

include_once '../../backend/init.php';


if(!$session->is_logged_in()) {
    redirect_to(URLROOT . '/admin/login.php');
}


$id = $_GET['id'];

//checks if id exists
$user = $query->find_by_id($id, 'users');
if($user === false) {
    redirect_to(URLROOT . '/admin/login.php');
}

$query->delete($id, 'users');
$session->message('User deleted', 'success');
redirect_to(URLROOT . '/admin/users/index.php');








