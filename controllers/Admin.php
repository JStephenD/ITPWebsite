<?php

class Admin extends Controller {
    function __construct($db) {
        $this->db = $db;
        $this->userModel = new UserModel($this->db);
        parent::__construct();
    }

    function admin_accounts($vars, $httpmethod) {
        $this->utils->login_required();
        $this->utils->permsRequired(
            (isset($_SESSION['user']['perms'])) ? $_SESSION['user']['perms'] : '0',
            ['admin']
        );

        if ($httpmethod == 'GET' || isset($_POST['ajax'])) {
            $users = $this->userModel->getAllUsers();
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/admin/admin_accounts.php';
        }
    }

    function admin_account_edit($vars, $httpmethod) {
        $this->utils->login_required();
        $this->utils->permsRequired(
            (isset($_SESSION['user']['perms'])) ? $_SESSION['user']['perms'] : '0',
            ['admin']
        );

        function checked($perms, $val) {
            if (in_array($val, $perms)) {
                return 'checked="checked"';
            }
        }

        if ($httpmethod == 'GET' || isset($_POST['ajax'])) {
            $data = [
                'filter' => 'id',
                'value' => $vars['id']
            ];
            $user = $this->userModel->getUser($data);
            $perms = $this->utils->getPermsAsList($user['perms']);

            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/admin/admin_account_edit.php';
        } else if ($httpmethod == 'POST') {
            $perms = $_POST['perms'];
            $new_perms_value = $this->utils->getPermsValue(explode(',', $perms));
            $data = [
                'id' => $vars['id'],
                'perms' => $new_perms_value
            ];

            sleep(1);

            $res = $this->userModel->updatePermissions($data);
            $_SESSION['user'] = $this->userModel->getUser(['filter' => 'id', 'value' => $_SESSION['user']['id']]);

            header('Content-Type: application/json');
            echo json_encode($res);
        }
    }

    function admin_account_delete($vars, $httpmethod) {
        $this->utils->login_required();
        $this->utils->permsRequired(
            (isset($_SESSION['user']['perms'])) ? $_SESSION['user']['perms'] : '0',
            ['admin']
        );

        if ($httpmethod == 'GET' || isset($_POST['ajax'])) {
            $data = [
                'id' => $vars['id']
            ];
            $res = $this->userModel->deleteAccount('user', $data);
            header('Location: /admin/accounts');
        }
    }
}
