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


    }