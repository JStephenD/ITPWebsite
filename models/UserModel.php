<?php

class UserModel {
    function __construct($db) {
        $this->db = $db;
        $this->table = 'user';
    }

    function getUserByUsername($table, $data) {
        $query = $this->db->prepare(
            "SELECT 
                id,
                username, 
                first_name, 
                last_name, 
                birthday,
                dp_url,
                perms
            FROM $table 
            WHERE username = :username"
        );
        $query->execute(array('username'=>$data['username']));
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    function getUser($data) {
        $filter = $data['filter'];
        $value = $data['value'];
        $query = $this->db->prepare(
            "SELECT
                id,
                username,
                first_name,
                last_name,
                birthday,
                dp_url,
                perms
            FROM 
                $this->table
            WHERE
                $filter = $value
            "
        );
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    function getAllUsers($data = [], $table = 'user') {
        $query = $this->db->prepare(
            "SELECT * 
            FROM $table
            "
        );
        $query->execute($data);
        $temp = $query->fetchAll(PDO::FETCH_ASSOC);
        $res = [];
        foreach ($temp as $row) {
            unset($row['password']);
            array_push($res, $row);
        }
        return $res;
    }

    function signUp($table, $data) {
        $query = $this->db->prepare(
            "INSERT INTO $table(
                username, 
                password
            ) VALUES (
                :username,
                :password
            )"
        );
        $query->execute($data);
    }

    function login($table, $data)
    {
        $query = $this->db->prepare(
            "SELECT 
                id,
                username, 
                first_name, 
                last_name, 
                birthday,
                dp_url,
                perms
            FROM $table 
            WHERE
                username = :username AND
                password = :password
            "
        );
        $query->execute($data);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            unset($result['password']);
            return $result;
        } else {
            return 'incorrectPassword';
        }
    }

    function updatePermissions($data) {
        $query = $this->db->prepare(
            "UPDATE $this->table SET
                perms = :perms
            WHERE id = :id
            "
        );
        if ($query->execute($data)) {
            return 'success';
        } else {
            return 'error';
        }
    }

    function updateAccount($table, $data) {
        $query = $this->db->prepare(
            "UPDATE $table SET
                first_name = :first_name,
                last_name = :last_name,
                birthday = :birthday,
                dp_url = :dp_url
            WHERE id = :id
            "
        );
        $query->execute($data);
    }

    function deleteAccount($table, $data) {
        $query = $this->db->prepare(
            "DELETE FROM $table
            WHERE id = :id
            "
        );
        if ($query->execute($data)) {
            return 'success';
        } else {
            return 'error';
        }
    }

    function logout($table, $data) {
        $query = $this->db->prepare(
            ""
        );
    }
}

?>