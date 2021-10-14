<?php

include_once '../../init.php';

$session->require_admin_login();


$id = $_GET['id'];

$question = $query->find_by_id($id, 'questions');
$answers = $query->find_all_by_id($id, 'answers', 'question_id');


if($question === false) {
    $session->message('Something went wrong.', 'danger');
    redirect_to(URLROOT . '/admin/users/index.php');
}

include(INCLUDES_PATH . '/header.php');
include(INCLUDES_PATH . '/navbar.php');

include 'views/show.view.php';


include(INCLUDES_PATH . '/footer.php');

