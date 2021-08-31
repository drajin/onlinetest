<?php



    class Admin
    {

        public function login() {
            $data = [
                'email' => '',
                'password' => '',
                'emailError' => '',
                'passwordError' => ''
            ];

            //Check for post
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                //Sanitize post data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'emailError' => '',
                    'passwordError' => '',
                ];
                //Validate email
                if (empty($data['email'])) {
                    $data['emailError'] = 'Please enter a email.';
                }

                //Validate password
                if (empty($data['password'])) {
                    $data['passwordError'] = 'Please enter a password.';
                }

                //Check if all errors are empty
                if (empty($data['emailError']) && empty($data['passwordError'])) {
                    $loggedInUser = $query->login($data);
                    return $loggedInUser;

                    if ($loggedInUser) {
                        $this->createUserSession($loggedInUser);
                    } else {
                        $data['passwordError'] = 'Password or email is incorrect. Please try again.';

                        $this->view('users/login', $data);
                    }
                }

            } else {
                $data = [
                    'email' => '',
                    'password' => '',
                    'emailError' => '',
                    'passwordError' => ''
                ];
            }
            //$this->view('users/login', $data);
        }

        public function createUserSession($user) {
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