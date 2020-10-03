<?php

class Tracing extends Controller {
    function __construct($db) {
        $this->db = $db;
        $this->employeesModel = new EmployeesModel($this->db);
        $this->customersModel = new CustomersModel($this->db);
        $this->loggingModel = new LoggingModel($this->db);
        parent::__construct();
    }

    // --------------------------------------------------------------------------------------------

    function tracing_logs_view($vars, $httpmethod) {
        $this->utils->login_required();
        $this->utils->permsRequired(
            (isset($_SESSION['user']['perms'])) ? $_SESSION['user']['perms'] : '0',
            ['logging_view']
        );

        function name($arr, $id) {
            foreach ($arr as $row) {
                if ($row['id'] == $id) {
                    return $row['last_name'] . ', ' . $row['first_name'];
                }
            }
        }

        if ($httpmethod == 'GET' || isset($_POST['ajax'])) {
            $employees = $this->employeesModel->getEmployees();
            $logs = $this->loggingModel->getLogs();

            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/tracing/logs_view.php';
        }
    }

    // --------------------------------------------------------------------------------------------

    function tracing_employee_add($vars, $httpmethod) {
        $this->utils->login_required();
        $this->utils->permsRequired(
            (isset($_SESSION['user']['perms'])) ? $_SESSION['user']['perms'] : '0',
            ['logging_employee_log']
        );

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
        $this->utils->login_required();
        $this->utils->permsRequired(
            (isset($_SESSION['user']['perms'])) ? $_SESSION['user']['perms'] : '0',
            ['logging_employee_log']
        );

        if ($httpmethod == 'GET' || isset($_POST['ajax'])) {
            $employees = $this->employeesModel->getEmployees();
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/tracing/employee_log.php';
        } else if ($httpmethod == 'POST') {
            $data = [
                'entry_type' => '1',
                'profile_id' => $_POST['employee-id'],
                'date' => $_POST['date'],
                'time' => $_POST['time'],
                'temp' => $_POST['temp']
            ];

            $this->loggingModel->log($data);

            sleep(1);

            header('Content-Type: application/json');
            echo json_encode('');
        }
    }

    // --------------------------------------------------------------------------------------------

    function tracing_customer_log($vars, $httpmethod) {
        $this->utils->login_required();
        $this->utils->permsRequired(
            (isset($_SESSION['user']['perms'])) ? $_SESSION['user']['perms'] : '0',
            ['logging_customer_log']
        );

        if ($httpmethod == 'GET' || isset($_POST['ajax'])) {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/tracing/customer_log.php';
        }
    }
}
