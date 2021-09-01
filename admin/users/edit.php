<?php

include_once '../../backend/init.php';

if($session->is_logged_in() === 'false') {
    redirect_to(URLROOT . '/admin/login.php');
}


$id = $_GET['id'];

$user = $query->find_by_id($id, 'users');
if($user === false) {

    redirect_to(URLROOT . '/admin/login.php');
}

include(INCLUDES_PATH . '/header.php');
include(INCLUDES_PATH . '/navbar.php');


$users = $query->select_all('users');

include 'views/edit.view.php';


include(INCLUDES_PATH . '/footer.php');

