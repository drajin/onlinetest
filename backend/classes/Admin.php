<?php



    class Admin
    {
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

                //Check if there is no errors
               // if (empty($data['email_error']) && empty($data['password_error'])) {
                    //ide log in
                 //   $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                   // if ($loggedInUser) {
    //                    $this->createUserSession($loggedInUser);
    //                } else {
    //                    $data['password_error'] = 'Password or email is incorrect. Please try again.';
    //
    //                   return $data;
    //                }

               // }

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

        private function addError($key, $val){
            $this->errors[$key] = $val;
        }

        public function display_errors($error)
        {
            if(isset($error)) {
                echo $error;
            }
        }

        public function set_flesh_message($msg, $type) {
            $alert = '<div class="alert alert-'.$type.' text-center" role="alert">';
            $alert .= $msg;
            $alert .= '</div>';
            return $alert;
        }

        public function create_user_session($user) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['email'] = $user->email;
            $_SESSION['email'] = $user->email;
            header('location:' . URLROOT . '/pages/index');
        }

        public function logout() {
            unset($_SESSION['user_id']);
            unset($_SESSION['email']);
            unset($_SESSION['email']);
            header('location:' . URLROOT . '/users/login');
        }
    }