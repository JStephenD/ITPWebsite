<?php
namespace controllers;
use models\User as UserModel;
use classes\Messages;
use classes\Utils;

class User {
    public function signup($vars, $httpmethod){
        if ($httpmethod == 'POST') {
            if (isset($_POST['signup'])) {
                $username = $_POST['username'];
                $data = [
                    'username' => $_POST['username'],
                    'password' => hash('sha256', $_POST['password']),
                ];

                $result = UserModel::signup('user', $data);
                if ($result == 'userAlreadyExists') {
                    Messages::add(
                        "User <strong>". $username ."</strong> already exist.", 
                        "danger"
                    );
                    header('Location: /user/signup');
                } else {
                    Messages::add(
                        "User account <strong>". $username. "</strong> created successfully.<hr>
                        You can login now.", 
                        "primary"
                    );
                    header('Location: /user/login?username=' . $username);
                }
            }
        }

        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/user_signup.php';
    }
    
    public function login($vars, $httpmethod){
        if ($httpmethod == 'POST') {
            if (isset($_POST['login'])) {
                $username = $_POST['username'];
                $data = [
                    'username' => $_POST['username'],
                    'password' => hash('sha256', $_POST['password'])
                ];

                $result = UserModel::login('user', $data);
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
            }
        }

        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/user_login.php';
    }

    public function account($vars, $httpmethod) {
        Utils::login_required();

        if ($httpmethod == 'POST') {
            if (isset($_POST['update'])) {
                $data = [
                    'first_name' => $_POST['first-name'],
                    'last_name' => $_POST['last-name'],
                    'birthday' => $_POST['birthday'],
                    'id' => $vars['id']
                ];

                var_dump($_POST);

                $result = UserModel::updateAccount('user', $data);

                Messages::add(
                    "User Profile updated successfully.",
                    "success"
                );
                $username = $_SESSION['user']['username'];
                $_SESSION['user'] = UserModel::getUserByUsername('user', ['username' => $username]);
                header('Location: /user/account/' . $vars['id']);
            }
        }

        $user = $_SESSION['user'];

        $first_name = $user['first_name'];
        $last_name = $user['last_name'];
        $birthday = $user['birthday'];

        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/user_account.php';
    }

    public function logout($vars, $httpmethod){
        unset($_SESSION['user']);
        Messages::add(
            "<strong>Logged out</strong> successfully.<hr>
            Note: Must be logged in to use the system.", 
            "dark"
        );
        header('Location: /user/login');
    }
}

?>