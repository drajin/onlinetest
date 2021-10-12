<?php

include_once '../../init.php';

if($session->is_logged_in() === 'false') {
    redirect_to(URLROOT . '/admin/login.php');
}

$users = $query->select_all('users');

include(INCLUDES_PATH . '/header.php');
include(INCLUDES_PATH . '/navbar.php');

include 'views/index.view.php';


include(INCLUDES_PATH . '/footer.php');

