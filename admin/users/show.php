<?php

include_once '../../backend/init.php';

if($session->is_logged_in() === 'false') {
    redirect_to('login.php');
}


$id = $_GET['id'];
$user = $query->find_by_id($id, 'users');

include(INCLUDES_PATH . '/header.php');
include(INCLUDES_PATH . '/navbar.php');


$users = $query->select_all('users');

include 'views/show.view.php';


include(INCLUDES_PATH . '/footer.php');

