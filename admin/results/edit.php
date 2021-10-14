<?php

include_once '../../init.php';

//checks if user is logged in
$session->require_admin_login();


$id = $_GET['id'];

$result_user = $result->find_by_id($id, 'results');
$user = $user_controller->find_by_id($result_user->user_id, 'users');

if($result_user === false) {
    $session->message('Something went wrong.', 'danger');
    redirect_to(URLROOT . '/admin/results/index.php');
}

$result_data = ($result->validate_update_result());

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($result_data['points_error']) && empty($result_data['correct_answ_error']) && empty($result_data['correct_answ_user_error']) ){
        //&& !empty($user_data['points']) && !empty($user_data['correct_answ']) && !empty($user_data['correct_answ_user'])) {


        if($result->update_result($id, $result_data)) {
            $session->message('Result updated successfully', 'success');
            redirect_to(URLROOT .'/admin/results/index.php');
        } else {
            $session->message('Something went wrong.', 'danger');
            redirect_to(URLROOT .'/admin/users/index.php');
        }
    } else {
        $errors = $result_data;
    }
}


include(INCLUDES_PATH . '/header.php');
include(INCLUDES_PATH . '/navbar.php');

include 'views/edit.view.php';

include(INCLUDES_PATH . '/footer.php');

