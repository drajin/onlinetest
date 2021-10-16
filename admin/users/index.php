<?php

include_once '../../init.php';
use app\classes\User;

$session->require_admin_login();

$users = User::select_all();

include(INCLUDES_PATH . '/header.php');
include(INCLUDES_PATH . '/navbar.php');

include 'views/index.view.php';


include(INCLUDES_PATH . '/footer.php');

