<?php

include_once '../init.php';

if($session->is_logged_in_admin()) {
    redirect_to(URLROOT . '/admin/index.php');
}

include(INCLUDES_PATH . '/header.php');

$errors = [];

$admin = ($user_controller->validate_login_admin());

//TODO if(empty($errors))
if (empty($admin->email_error) && empty($admin->password_error)
    && !empty($admin->email) && !empty($admin->password)) {



    if($user_controller->login_admin($admin)) {
        redirect_to(URLROOT . '/admin/index.php');
        } else {
        $session->message('Username/Password combination is wrong', 'danger');
    }


} else {
    $errors = $admin;
}



include_once 'views/login.view.php';

include(INCLUDES_PATH . '/footer.php');

