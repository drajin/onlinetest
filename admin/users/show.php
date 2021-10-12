<?php

include_once '../../init.php';

if($session->is_logged_in() === 'false') {
    redirect_to(URLROOT . '/admin/login.php');
}


$id = $_GET['id'];

$user = $query->find_by_id($id, 'users');
if($user === false) {
    $session->message('Something went wrong.', 'danger');
    redirect_to(URLROOT . '/admin/questions/index.php');
}

include(INCLUDES_PATH . '/header.php');
include(INCLUDES_PATH . '/navbar.php');

include 'views/show.view.php';


include(INCLUDES_PATH . '/footer.php');

