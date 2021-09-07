<?php

include_once '../../backend/init.php';

if(!$session->is_logged_in()) {
    redirect_to(URLROOT . '/admin/login.php');
}


$id = $_GET['id'];

$question = $query->find_by_id($id, 'questions');
if($question === false) {
    $session->message('Something went wrong.', 'danger');
    redirect_to(URLROOT . '/admin/users/index.php');
}

include(INCLUDES_PATH . '/header.php');
include(INCLUDES_PATH . '/navbar.php');

include 'views/show.view.php';


include(INCLUDES_PATH . '/footer.php');

