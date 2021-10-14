<?php

include_once '../init.php';

if($session->is_logged_in_admin()) {
    redirect_to(URLROOT . '/admin/index.php');
}

include(INCLUDES_PATH . '/header.php');

$errors = [];

$admin_data = ($user_controller->validate_login_admin());

//TODO if(empty($errors))
if (empty($admin_data['email_error']) && empty($admin_data['password_error'])
    && !empty($admin_data['email']) && !empty($admin_data['password'])) {



    if($user_controller->login_admin($admin_data)) {
        redirect_to(URLROOT . '/admin/index.php');
        } else {
        $session->message('Username/Password combination is wrong', 'danger');
    }


} else {
    $errors = $admin_data;
}



include_once 'views/login.view.php';

include(INCLUDES_PATH . '/footer.php');

