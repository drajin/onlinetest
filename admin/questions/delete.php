<?php

include_once '../../backend/init.php';


if(!$session->is_logged_in()) {
    redirect_to(URLROOT . '/admin/login.php');
}


$id = $_GET['id'];

//checks if id exists
$question = $query->find_by_id($id, 'questions');
if($question === false) {
    redirect_to(URLROOT . '/admin/login.php');
}

$query->delete($id, 'questions');
$session->message('Question deleted', 'success');
redirect_to(URLROOT . '/admin/questions/index.php');








