<?php

include_once '../../backend/init.php';

if($session->is_logged_in() === 'false') {
    redirect_to(URLROOT . '/admin/login.php');
}

$questions = $query->select_all('questions');



include(INCLUDES_PATH . '/header.php');
include(INCLUDES_PATH . '/navbar.php');


include 'views/index.view.php';


include(INCLUDES_PATH . '/footer.php');

