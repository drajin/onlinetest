<?php

include_once '../../init.php';
use app\classes\Result;

$session->require_admin_login();


$id = $_GET['id'];

//checks if id exists
$result = Result::find_by_id($id);

if(!$result) {
    redirect_to(URLROOT . '/admin/login.php');
}

Result::delete($id);

$session->message('Result deleted', 'success');
redirect_to($_SERVER['HTTP_REFERER']);









