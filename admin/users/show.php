<?php

include_once '../../init.php';
use app\classes\User;

$session->require_admin_login();


$id = $_GET['id'];

$user = User::find_by_id($id);
$user_results = $result->get_results_for_user($id);
if(!$user) {
    $session->message('Something went wrong.', 'danger');
    redirect_to(URLROOT . '/admin/questions/index.php');
}

include(INCLUDES_PATH . '/header.php');
include(INCLUDES_PATH . '/navbar.php');

include 'views/show.view.php';


include(INCLUDES_PATH . '/footer.php');

