<?php

include_once '../../init.php';
use app\classes\User;

//checks if user is logged in
$session->require_admin_login();


$id = $_GET['id'];

$user = User::find_by_id($id);
if(!$user) {
    $session->message('Something went wrong.', 'danger');
    redirect_to(URLROOT . '/admin/users/index.php');
}

$validated_user = ($user_controller->validate_update_user());


if (empty($validated_user->first_name_error) && empty($validated_user->last_name_error) && empty($validated_user->email_error)
    && !empty($validated_user->first_name) && !empty($validated_user->last_name) && !empty($validated_user->email)) {

    if($user_controller->update_user($validated_user, $id)) {
        $session->message('User updated successfully', 'success');
        redirect_to(URLROOT .'/admin/users/index.php');
    } else {
        $session->message('Something went wrong.', 'danger');
        redirect_to(URLROOT .'/admin/users/index.php');
    }
} else {
    $errors = $validated_user;
}

include(INCLUDES_PATH . '/header.php');
include(INCLUDES_PATH . '/navbar.php');

include 'views/edit.view.php';

include(INCLUDES_PATH . '/footer.php');

