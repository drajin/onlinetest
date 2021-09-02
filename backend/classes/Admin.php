<?php



    class Admin
    {
        //TODO add private property for tables
        //TODO make validate reusable
       // private string $table = 'users';

        public function validate_login_data() {
            $data = [
                'email' => '',
                'password' => '',
                'email_error' => '',
                'password_error' => ''
            ];

            //Check for post
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                //Sanitize post data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'email_error' => '',
                    'password_error' => '',
                ];
                //Validate email
                if (empty($data['email'])) {
                    $data['email_error'] = 'Please enter an email.';
                } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    $data['email_error'] = 'Please enter a valid email address.';
                }

                //Validate password
                if (empty($data['password'])) {
                    $data['password_error'] = 'Please enter a password.';
                }

            } else {
                $data = [
                    'email' => '',
                    'password' => '',
                    'email_error' => '',
                    'password_error' => ''
                ];
            }
            return $data;
        }

        public function validate_update_user() {
            $data = [
                'first_name' => '',
                'last_name' => '',
                'email' => '',
                'first_name_error' => '',
                'last_name_error' => '',
                'email_error' => '',
            ];

            //Check for post
            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                //Sanitize post data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'first_name' => trim($_POST['first_name']),
                    'last_name' => trim($_POST['last_name']),
                    'email' => trim($_POST['email']),
                    'first_name_error' => '',
                    'last_name_error' => '',
                    'email_error' => '',
                ];

                //Validate first name
                if (empty($data['first_name'])) {
                    $data['first_name_error'] = 'First Name can\'t be blank.';
                }

                //Validate last name
                if (empty($data['last_name'])) {
                    $data['last_name_error'] = 'Last Name can\'t be blank.';
                }

                //Validate email
                if (empty($data['email'])) {
                    $data['email_error'] = 'Email can\'t be blank.';
                } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    $data['email_error'] = 'Please enter a valid email address.';
                }



            } else {
                $data = [
                    'email' => '',
                    'password' => '',
                    'email_error' => '',
                    'password_error' => ''
                ];
            }
            return $data;
        }


        public function validate_question() {

            $data = [
                'question_text' => '',
                'answer_1' => '',
                'answer_2' => '',
                'answer_3' => '',
                'answer_4' => '',
                'correct_answer' => '',
                'points' => '',
                'question_text_error' => '',
                'answer_1_error' => '',
                'answer_2_error' => '',
                'answer_3_error' => '',
                'answer_4_error' => '',
                'correct_answer_error' => '',
                'points_error' => '',
            ];

            //Check for post
            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                //Sanitize post data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'question_text' => trim($_POST['question_text']),
                    'answer_1' => trim($_POST['answer_1']),
                    'answer_2' => trim($_POST['answer_2']),
                    'answer_3' => trim($_POST['answer_3']),
                    'answer_4' => trim($_POST['answer_4']),
                    'correct_answer' => trim($_POST['correct_answer']),
                    'points' => trim($_POST['points']),
                    'question_text_error' => '',
                    'answer_1_error' => '',
                    'answer_2_error' => '',
                    'answer_3_error' => '',
                    'answer_4_error' => '',
                    'correct_answer_error' => '',
                    'points_error' => '',
                ];

                //Validate Question
                if (empty($data['question_text'])) {
                    $data['question_text_error'] = 'Question can\'t be blank.';
                }

                //Validate Answers
                if (empty($data['answer_1'])) {
                    $data['answer_1_error'] = 'Answer 1 can\'t be blank.';
                }

                if (empty($data['answer_2'])) {
                    $data['answer_2_error'] = 'Answer 2 can\'t be blank.';
                }

                if (empty($data['answer_3'])) {
                    $data['answer_3_error'] = 'Answer 3 can\'t be blank.';
                }

                if (empty($data['answer_4'])) {
                    $data['answer_4_error'] = 'Answer 4 can\'t be blank.';
                }

                //Validate Correct Answer
                if (empty($data['correct_answer'])) {
                    $data['correct_answer_error'] = 'Correct Answer can\'t be blank.';
                }

                //Validate Points
                if (empty($data['points'])) {
                    $data['points_error'] = 'Points can\'t be blank.';
                } elseif(!is_numeric($data['points'])) {
                    $data['points_error'] = 'Points must be a Number.';
                } elseif($data['points'] > 10) {
                    $data['points_error'] = 'Points must be a Number between 1 and 10.';
                } elseif($data['points'] < 1) {
                    $data['points_error'] = 'Points must be a Number between 1 and 10.';
                }



            } else {
                $data = [
                    'question_text' => '',
                    'answer_1' => '',
                    'answer_2' => '',
                    'answer_3' => '',
                    'answer_4' => '',
                    'correct_answer' => '',
                    'points' => '',
                ];
            }
            return $data;
        }



    }