<?php

include_once '../../backend/init.php';

$questions = $query->select_all('questions');
include(INCLUDES_PATH . '/header.php');
include(INCLUDES_PATH . '/navbar.php');

if($session->is_logged_in() === 'false') {
    redirect_to('login.php');
}





include(INCLUDES_PATH . '/footer.php');


var_dump($questions);
?>
<h1>Questions</h1>

