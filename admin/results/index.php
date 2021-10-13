<?php

include_once '../../init.php';

if($session->is_logged_in() === 'false') {
    redirect_to(URLROOT . '/admin/login.php');
}

$results = $result->get_all_user_results();

include(INCLUDES_PATH . '/header.php');
include(INCLUDES_PATH . '/navbar.php');

include 'views/index.view.php';


include(INCLUDES_PATH . '/footer.php');

