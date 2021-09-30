<?php

include_once '../../backend/init.php';

//checks if user is logged in
if($session->is_logged_in() === 'false') {
    redirect_to(URLROOT . '/admin/login.php');
}


$id = $_GET['id'];

$user = $query->find_by_id($id, 'users');
if($user === false) {
    $session->message('Something went wrong.', 'danger');
    redirect_to(URLROOT . '/admin/users/index.php');
}

$user_data = ($admin->validate_update_user());


if (empty($user_data['first_name_error']) && empty($user_data['last_name_error']) && empty($user_data['email_error'])
    && !empty($user_data['first_name']) && !empty($user_data['last_name']) && !empty($user_data['email'])) {

    if($query->update_user($user_data, $id)) {
        $session->message('User updated successfully', 'success');
        redirect_to(URLROOT .'/admin/users/index.php');
    } else {
        $session->message('Something went wrong.', 'danger');
        redirect_to(URLROOT .'/admin/users/index.php');
    }
} else {
    $errors = $user_data;
}

include(INCLUDES_PATH . '/header.php');
include(INCLUDES_PATH . '/navbar.php');

include 'views/edit.view.php';

include(INCLUDES_PATH . '/footer.php');

