<?php

namespace onlinetest\classes;
use PDO;

class User extends QueryBuilder {

    protected static string $table_name = 'users';

    public function login_or_register($data) {
        $count = count(get_object_vars($data)); //checks on number of properties
        if($count > 2) {
            return $this->register($data);
        } else {
            return $this->login($data);
        }
    }


    private function register($data)
    {
        $score = null;
        $time = null;
        $created_at = null;
        $updated_at = null;
        $is_admin = false;
        $password_hash = password_hash($data->password, PASSWORD_DEFAULT);

        $stmt = self::$db->prepare('INSERT INTO users VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bindParam(':first_date', $data->first_name);
        $stmt->bindParam(':last_name', $data->last_name);
        $stmt->bindParam(':email', $data->email);
        $stmt->bindParam(':$password', $password_hash);
        $stmt->bindParam(':score', $score);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->bindParam(':updated_at', $updated_at);

        $result = $stmt->execute([NULL, $data->first_name, $data->last_name, $data->email, $password_hash, $is_admin, NULL, NULL, NULL, NULL]);
        if($result) {
            echo "success";
        } else {
            return "error";
        }
    }


    public function login($data)
    {


        // checks if user or admin exists
        $user = $this->findUserByEmail($data->email);
        if(!$user) {
            return false;
        }


        $hashedPassword = $user->password;
        // checks if passwords are the same
        if(password_verify($data->password,$hashedPassword)){
            return self::$session->login($user);
        } else {
            return false;
        }

    }

    public function login_admin($data)
    {

        // checks if user or admin exists
        $user = $this->findUserByEmail($data->email);
        if(!$user) {
            return false;
        }

        if($user->is_admin) {
            $hashedPassword = $user->password;
            // checks if passwords are the same
            if(password_verify($data->password,$hashedPassword)){
                return self::$session->login($user);
            } else {
                return false;
            }
        } else {
            self::$session->message('Admin rights are required.', 'danger');
            redirect_to(URLROOT . '/admin/login.php');
        }
    }

    public function validate_login_admin() {
        $data = (object)[
            'email' => '',
            'password' => '',
            'email_error' => '',
            'password_error' => ''
        ];

        //Check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = (object)[
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_error' => '',
                'password_error' => '',
            ];
            //Validate email
            if (empty($data->email)) {
                $data->email_error = 'Please enter an email.';
            } elseif (!filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
                $data->email_error = 'Please enter a valid email address.';
            }

            //Validate password
            if (empty($data->password)) {
                $data->password_error = 'Please enter a password.';
            }

        } else {
            $data = (object) [
                'email' => '',
                'password' => '',
                'email_error' => '',
                'password_error' => ''
            ];
        }
        return $data;
    }

    public function validate_update_user() {
        $data = (object) [
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
            $data = (object) [
                'first_name' => trim($_POST['first_name']),
                'last_name' => trim($_POST['last_name']),
                'email' => trim($_POST['email']),
                'first_name_error' => '',
                'last_name_error' => '',
                'email_error' => '',
            ];

            //Validate first name
            if (empty($data->first_name)) {
                $data->first_name_error = 'First Name can\'t be blank.';
            }

            //Validate last name
            if (empty($data->last_name)) {
                $data->last_name_error = 'Last Name can\'t be blank.';
            }

            //Validate email
            if (empty($data->email)) {
                $data->email_error = 'Email can\'t be blank.';
            } elseif (!filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
                $data->email_error = 'Please enter a valid email address.';
            }



        } else {
            $data = (object) [
                'email' => '',
                'password' => '',
                'email_error' => '',
                'password_error' => ''
            ];
        }
        return $data;
    }


    public function findUserByEmail($email) {
        $stmt = self::$db->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bindParam(':email', $email);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_OBJ);

    }

    //user
    //TODO array or obj
    public function update_user($user, $id) {

        if(gettype($user) === 'array') {
            $user = (object)$user;
        }
        try {
            $stmt = self::$db->prepare("UPDATE users SET first_name=:first_name, last_name=:last_name, email=:email, updated_at=NOW() WHERE id=:id");
            $stmt->bindparam(":first_name",$user->first_name);
            $stmt->bindparam(":last_name",$user->last_name);
            $stmt->bindparam(":email",$user->email);
            $stmt->bindparam(":id",$id);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }

    }

}
