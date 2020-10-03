<?php

class CustomersModel {
    function __construct($db, $table = 'customers') {
        $this->db = $db;
        $this->table = $table;
    }

    function getCustomer($data) {
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

    function getCustomers() {
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

    function addCustomer($data) {
        $query = $this->db->prepare(
            "INSERT INTO
                $this->table(
                    first_name,
                    last_name,
                    phone_number,
                    email,
                    address,
                )
            VALUES(
                :first_name,
                :last_name,
                :phone_number,
                :email,
                :address,
            )"
        );
        if ($query->execute($data)) {
            return 'success';
        }
    }

    function editCustomer($data) {
        $query = $this->db->prepare(
            "UPDATE
                $this->table
            SET
                first_name = :first_name,
                last_name = :last_name,
                phone_number = :phone_number,
                email = :email,
                address = :address,
            WHERE
                id = :id"
        );
        $query->execute($data);
    }
}
