<?php

class Tracing extends Controller {
    function __construct($db) {
        $this->db = $db;
        $this->employeesModel = new EmployeesModel($this->db);
        parent::__construct();
    }

    function tracing_employee_add($vars, $httpmethod) {
        if ($httpmethod == 'POST') {
            $data = [
                'first_name' => $_POST['first-name'],
                'last_name' => $_POST['last-name'],
                'phone_number' => $_POST['phone-number'],
                'email' => $_POST['email'],
                'position' => $_POST['position'],
                'birthday' => $_POST['birthday']
            ];

            sleep(1);

            header('Content-Type: application/json');
            if ($this->employeesModel->addEmployee($data) == 'success') {
                echo json_encode([
                    'status' => 200,
                    'statusText' => 'Success',
                    'responseText' => 'Employee Profile Added'
                ]);
            } else {
                echo json_encode([
                    'status' => 400,
                    'statusText' => 'Bad Request',
                    'responseText' => 'Employee Profile not added'
                ]);
            }
        }
    }

    function tracing_employee_log($vars, $httpmethod) {
        if ($httpmethod == 'GET' || isset($_POST['ajax'])) {
            $employees = $this->employeesModel->getEmployees();
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/tracing/employee_log.php';
        }
    }

    // --------------------------------------------------------------------------------------------

    function tracing_customer_log($vars, $httpmethod) {
        if ($httpmethod == 'GET' || isset($_POST['ajax'])) {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/tracing/customer_log.php';
        }
    }
}
