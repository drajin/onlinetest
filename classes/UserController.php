<?php

include_once 'Session.php';

    class UserController extends QueryBuilder {

        //ide u login
        public function login_or_register($data) {
            $count = count(get_object_vars($data)); //checks on number of properties
            if($count > 2) {
                return $this->register($data);
            } else {
                return $this->login($data, 'users');
            }
        }

        //ide u login
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

            //ide u login
            public function login($data)
            {
                //changes array in obj
                if(gettype($data) === 'array') {
                    $data = (object)$data;
                }

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

            //probamo da napravimo abstract
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