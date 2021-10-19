<?php

include_once '../../init.php';
use onlinetest\classes\Question;
use onlinetest\classes\Answer;

$session->require_admin_login();


$id = $_GET['id'];

$question = Question::find_by_id($id);
$answers = Answer::find_all_by_id($id, 'question_id');


if(!$question) {
    $session->message('Something went wrong.', 'danger');
    redirect_to(URLROOT . '/admin/users/index.php');
}

include(INCLUDES_PATH . '/header.php');
include(INCLUDES_PATH . '/navbar.php');

include 'views/show.view.php';


include(INCLUDES_PATH . '/footer.php');

