<?php

class User extends Controller {
    function __construct($db) {
        $this->db = $db;
        $this->userModel = new UserModel($this->db);
        $this->utils = new Utils();
    }

    public function signup($vars, $httpmethod){
        if ($httpmethod == 'POST') {
            $username = isset($_POST['username']) ? $_POST['username'] : '';
            $password = isset($_POST['password']) ? hash('sha256', $_POST['password']) : '';

            $data = [
                'username' => $username,
                'password' => $password,
            ];

            if ($this->userModel->getUserByUsername('user', $data)) {
                $response = [
                    "status" => "500",
                    "statusText" => "Sign up Error",
                    "responseText" => "User Already Exists"
                ];
                header('Content-Type: application/json');
                echo json_encode($response);
            } 
            if (!isset($_POST['checkUser'])) {
                sleep(1);

                $result = $this->userModel->signUp('user', $data);
            }
            
        } else {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/user/user_signup.php';
        }
    }
    
    public function login($vars, $httpmethod){
        if ($httpmethod == 'POST') {
            $username = $_POST['username'];
            $data = [
                'username' => $_POST['username'],
                'password' => hash('sha256', $_POST['password'])
            ];

            $result = $this->userModel->login('user', $data);
            if ($result == 'userDoesNotExist') {
                Messages::add(
                    "User <strong>". $username ."</strong> does not exist. Please check your credentials.", 
                    "danger"
                );
                header('Location: /user/login');
            } else if ($result == 'incorrectPassword') {
                Messages::add(
                    "Incorrect <strong>password</strong>. Please try again.", 
                    "danger"
                );
                header('Location: /user/login?username=' . $username);
            } else {
                $_SESSION['user'] = $result;
                Messages::add(
                    "Welcome user <strong>". $username ."</strong>. Login successful.", 
                    "primary"
                );
                header('Location: /user/account/' . $_SESSION['user']['id']);
            }
        } else {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/user/user_login.php';
        }
    }

    public function account($vars, $httpmethod) {
        $this->utils->login_required();

        if ($httpmethod == 'POST') {
            $data = [
                'first_name' => $_POST['first-name'],
                'last_name' => $_POST['last-name'],
                'birthday' => $_POST['birthday'],
                'id' => $vars['id']
            ];

            var_dump($_POST);

            $result = $this->userModel->updateAccount('user', $data);

            Messages::add(
                "User Profile updated successfully.",
                "success"
            );
            $username = $_SESSION['user']['username'];
            $_SESSION['user'] = $this->userModel->getUserByUsername('user', ['username' => $username]);
            header('Location: /user/account/' . $vars['id']);
        } else {
            $user = $_SESSION['user'];

            $first_name = $user['first_name'];
            $last_name = $user['last_name'];
            $birthday = $user['birthday'];

            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/user/user_account.php';
        }
    }

    public function logout($vars, $httpmethod) {
        session_unset();
        session_destroy();
        session_start();
        
        Messages::add(
            "<strong>Logged out</strong> successfully.<hr>
            Note: Must be logged in to use the system.", 
            "dark"
        );

        sleep(1);
    }
}

?>