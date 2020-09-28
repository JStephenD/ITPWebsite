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

    function admin_accounts_delete($vars, $httpmethod) {
        if ($httpmethod == 'POST') {
            $id = $vars['id'];
        }
    }
}
