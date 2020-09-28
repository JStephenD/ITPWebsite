<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/models/Connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/UserModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/Utils.php';

$utils = new Utils();
$db = new Connection();
$user_model = new UserModel($db->connect());
$users = $user_model->getAllUsers();
$utils->pre_r($users);
