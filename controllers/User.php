<?php

class User extends Controller {
    function __construct($db) {
        $this->db = $db;
        $this->userModel = new UserModel($this->db);
        parent::__construct();
    }

    public function user_signup($vars, $httpmethod) {
        if ($httpmethod == 'GET' || isset($_POST['ajax'])) {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/user/user_signup.php';
        } else if ($httpmethod == 'POST') {
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
            
        }
    }

    public function user_login($vars, $httpmethod) {
        if ($httpmethod == 'GET' || isset($_POST['ajax'])) {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/user/user_login.php';
        } else if (isset($_POST['checkUser'])) {
            $username = $_POST['username'];

            if ($this->userModel->getUserByUsername(
                'user',
                ['username' => $username]
            )) {
                $response = [
                    'status' => 200,
                    'statusText' => 'ok',
                    'responseText' => 'User Exists'
                ];
            } else {
                $response = [
                    'status' => 500,
                    'statusText' => 'server error',
                    'responseText' => 'User Does Not Exists'
                ];
            }
            header('Content-Type: application/json');
            echo json_encode($response);

        } else if ($httpmethod == 'POST') {
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
                unset($_SESSION['user']);
                $_SESSION['user'] = $result;
                Messages::add(
                    "Welcome user <strong>". $username ."</strong>. Login successful.", 
                    "primary"
                );
                header('Location: /user/account');
            }
        }
    }

    public function user_account($vars, $httpmethod) {
        $this->utils->login_required();
        $this->utils->permsRequired(
            (isset($_SESSION['user']['perms'])) ? $_SESSION['user']['perms'] : '0',
            ['user_account'],
            '/'
        );

        $user = $_SESSION['user'];

        $id = $user['id'];
        $first_name = $user['first_name'];
        $last_name = $user['last_name'];
        $birthday = $user['birthday'];
        $dp_url = $user['dp_url'];

        if ($httpmethod == 'GET' || isset($_POST['ajax'])) {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/user/user_account.php';
        } else if ($httpmethod == 'POST') {
            if ($_POST['updatedDP'] == 'true') {
                $file = $_FILES['dp'];

                $fname = $file['name'];
                $ftype = $file['type'];
                $ftmpName = $file['tmp_name'];
                $fsize = $file['size'];
                $ferror = $file['error'];

                $fext = explode('.', $fname);
                $fextActual = strtolower(end($fext));

                $allowed = ['jpg', 'jpeg', 'png'];

                if (in_array($fextActual, $allowed)) {
                    if ($ferror == 0) {
                        if ($fsize < (1024 * 1024 * 5)) {
                            $imgFileName = uniqid('', true) . "." . $fextActual;
                            $fdest = 'uploads/profile_picture/' . $imgFileName;

                            try {
                                unlink($_SESSION['user']['dp_url']);
                            } catch (Exception $e) {
                            }
                            move_uploaded_file($ftmpName, $fdest);

                            $data = [
                                'first_name' => (isset($_POST['first-name']) ? $_POST['first-name'] : $first_name),
                                'last_name' => (isset($_POST['last-name']) ? $_POST['last-name'] : $last_name),
                                'birthday' => (isset($_POST['birthday']) ? $_POST['birthday'] : $birthday),
                                'dp_url' => $fdest,
                                'id' => $_SESSION['user']['id']
                            ];

                            $result = $this->userModel->updateAccount('user', $data);

                            $username = $_SESSION['user']['username'];
                            unset($_SESSION['user']);
                            $_SESSION['user'] = $this->userModel->getUserByUsername('user', ['username' => $username]);
                            if (isset($_POST['dp_upload'])) {
                                header('Content-Type: application/json');
                                echo json_encode($_SESSION['user']);

                                return;
                            }

                            sleep(1);

                            header('Content-Type: application/json');
                            echo json_encode($_SESSION['user']);
                        }
                    }
                }
            } else {
                $data = [
                    'first_name' => (isset($_POST['first-name']) ? $_POST['first-name'] : $first_name),
                    'last_name' => (isset($_POST['last-name']) ? $_POST['last-name'] : $last_name),
                    'birthday' => (isset($_POST['birthday']) ? $_POST['birthday'] : $birthday),
                    'dp_url' => $_SESSION['user']['dp_url'],
                    'id' => $_SESSION['user']['id']
                ];

                $result = $this->userModel->updateAccount('user', $data);

                $username = $_SESSION['user']['username'];
                unset($_SESSION['user']);
                $_SESSION['user'] = $this->userModel->getUserByUsername('user', ['username' => $username]);

                sleep(1);

                header('Content-Type: application/json');
                echo json_encode($_SESSION['user']);
            }
        }
    }

    public function user_logout($vars, $httpmethod)
    {
        session_unset();
        session_destroy();
        session_start();
        
        Messages::add(
            "<strong>Logged out</strong> successfully.<hr>
            Note: Must be logged in to use the system.", 
            "dark"
        );

        sleep(.8);

        echo json_encode("");
    }
}
