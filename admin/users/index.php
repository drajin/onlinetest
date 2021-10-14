<?php

include_once '../../init.php';

$session->require_admin_login();

$users = $query->select_all('users');

include(INCLUDES_PATH . '/header.php');
include(INCLUDES_PATH . '/navbar.php');

include 'views/index.view.php';


include(INCLUDES_PATH . '/footer.php');

