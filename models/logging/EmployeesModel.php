<?php

class EmployeesModel {
    function __construct($db, $table = 'employees') {
        $this->db = $db;
        $this->table = $table;
    }

    function getEmployee($data) {
        $query = $this->db->prepare(
            "SELECT
                *
            FROM
                $this->table
            WHERE
                :filter = :value"
        );
        $query->execute($data);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function getEmployees() {
        $query = $this->db->query(
            "SELECT 
                * 
            FROM 
                $this->table 
            ORDER BY last_name"
        );
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function addEmployee($data) {
        $query = $this->db->prepare(
            "INSERT INTO
                $this->table(
                    first_name,
                    last_name,
                    phone_number,
                    email,
                    position,
                    birthday
                )
            VALUES(
                :first_name,
                :last_name,
                :phone_number,
                :email,
                :position,
                :birthday
            )"
        );
        if ($query->execute($data)) {
            return 'success';
        }
    }

    function editEmployee($data) {
        $query = $this->db->prepare(
            "UPDATE
                $this->table
            SET
                first_name = :first_name,
                last_name = :last_name,
                phone_number = :phone_number,
                email = :email,
                position = :position,
                birthday = :birthday
            WHERE
                id = :id"
        );
        $query->execute($data);
    }
}
