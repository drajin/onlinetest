<?php

include_once '../../backend/init.php';

$users = $query->select_all('users');

include(INCLUDES_PATH . '/header.php');
include(INCLUDES_PATH . '/navbar.php');

if($session->is_logged_in() === 'false') {
    redirect_to('login.php');
}

$users = $query->select_all('users');
var_dump($users);

include 'views/index.view.php';


include(INCLUDES_PATH . '/footer.php');
