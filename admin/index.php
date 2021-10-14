<?php
//TODO .htaccess
include_once '../init.php';

$session->require_admin_login();


include(INCLUDES_PATH . '/header.php');
include(INCLUDES_PATH . '/navbar.php');





include 'views/index.view.php';



include(INCLUDES_PATH . '/footer.php');