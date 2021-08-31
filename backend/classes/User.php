

    class User {

        public function createUserSession($user) {
            session_start();
            $_SESSION['user_id'] = $user->id;
            $_SESSION['email'] = $user->email;
            $_SESSION['user_id'] = $user->id;
        }

    }