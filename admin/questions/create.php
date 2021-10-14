<?php

include_once '../../init.php';

//checks if question is logged in
$session->require_admin_login();


//$new_question = $admin->validate_question();
//TODO check errors function if(!errors)
//if (empty($new_question['question_text_error']) && empty($new_question['answer_1_error']) && empty($new_question['answer_2_error'])
//    && empty($new_question['answer_3_error']) && empty($new_question['answer_4_error']) && empty($new_question['correct_answer_error']) && empty($new_question['points_error'])
//    && !empty($new_question['question_text']) && !empty($new_question['answer_1']) && !empty($new_question['answer_2'])) {
//
//        if($query->create_question($new_question)) {
//        $session->message('Quiz added successfully', 'success');
//        redirect_to(URLROOT .'/admin/questions/index.php');
//    } else {
//        $session->message('Something went wrong.', 'danger');
//        redirect_to(URLROOT .'/admin/questions/index.php');
//    }
//}

include(INCLUDES_PATH . '/header.php');
include(INCLUDES_PATH . '/navbar.php');

include 'views/create.view.php';

include(INCLUDES_PATH . '/footer.php');

