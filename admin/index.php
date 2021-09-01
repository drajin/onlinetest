<?php

include_once '../backend/init.php';

include(INCLUDES_PATH . '/header.php');
include(INCLUDES_PATH . '/navbar.php');

if($session->is_logged_in() === 'false') {
    redirect_to('login.php');
}



include_once 'views/index.view.php';



include(INCLUDES_PATH . '/footer.php');