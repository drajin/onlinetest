

    class User {

        public function createUserSesstion($user) {
            session_start();
            $_SESSION['user_id'] = $user->id;
            $_SESSION['email'] = $user->email;
            $_SESSION['user_id'] = $user->id;
        }

    }