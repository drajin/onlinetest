<?php

include_once '../backend/init.php';

if($session->is_logged_in() === 'true') {
    redirect_to(URLROOT . 'admin/index.php');
}

include(INCLUDES_PATH . '/header.php');

$errors = [];

$admin_data = ($admin->validate_login_data());


if (empty($admin_data['email_error']) && empty($admin_data['password_error'])
    && !empty($admin_data['email']) && !empty($admin_data['password'])) {

    $error_msg = $query->login($admin_data, 'admins');
    $session->message($error_msg, 'danger');

} else {
    $errors = $admin_data;
}

//var_dump($session->is_logged_in());



include_once 'views/login.view.php';

include(INCLUDES_PATH . '/footer.php');

