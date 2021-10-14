<?php

include_once '../../init.php';

//checks if question is logged in
$session->require_admin_login();


include(INCLUDES_PATH . '/header.php');
include(INCLUDES_PATH . '/navbar.php');

include 'views/create.view.php';

include(INCLUDES_PATH . '/footer.php');

