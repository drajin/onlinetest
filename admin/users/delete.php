<?php

include_once '../../init.php';
use onlinetest\classes\User;
use onlinetest\classes\Result;

$session->require_admin_login();


$id = $_GET['id'];

//checks if id exists
$user = User::find_by_id($id);
$results = Result::find_all_by_id($id, 'user_id');

if(!$user) {
    redirect_to(URLROOT . '/admin/login.php');
}

User::delete($id);

foreach($results as $result) {
    Result::delete_by_id($result->user_id, 'user_id');
}


$session->message('User deleted', 'success');
redirect_to(URLROOT . '/admin/users/index.php');








