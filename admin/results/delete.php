<?php

include_once '../../init.php';


if($session->is_logged_in() === 'false') {
    redirect_to(URLROOT . '/admin/login.php');
}


$id = $_GET['id'];

//checks if id exists
$result = $query->find_by_id($id, 'results');

if($result === false) {
    redirect_to(URLROOT . '/admin/login.php');
}

$query->delete($id, 'results');

$session->message('Result deleted', 'success');
redirect_to(URLROOT . '/admin/results/index.php');








