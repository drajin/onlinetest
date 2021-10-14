<?php

include_once '../../init.php';


$session->require_admin_login();


$id = $_GET['id'];

//checks if id exists
$result = $query->find_by_id($id, 'results');

if($result === false) {
    redirect_to(URLROOT . '/admin/login.php');
}

$query->delete($id, 'results');

$session->message('Result deleted', 'success');
header('Location: ' . $_SERVER['HTTP_REFERER']);









