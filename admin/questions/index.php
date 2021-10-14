<?php

include_once '../../init.php';

$session->require_admin_login();

$questions = $query->select_all('questions');



include(INCLUDES_PATH . '/header.php');
include(INCLUDES_PATH . '/navbar.php');


include 'views/index.view.php';


include(INCLUDES_PATH . '/footer.php');

