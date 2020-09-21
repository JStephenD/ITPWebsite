<?php

class UserModel {
    function __construct($db) {
        $this->db = $db;
    }

    function getUserByUsername($table, $data) {
        $query = $this->db->prepare(
            "SELECT 
                id,
                username, 
                first_name, 
                last_name, 
                birthday,
                dp_url
            FROM $table 
            WHERE username = :username"
        );
        $query->execute(array('username'=>$data['username']));
        return $query->fetch(PDO::FETCH_ASSOC);
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
                dp_url
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

    function logout($table, $data) {
        $query = $this->db->prepare(
            ""
        );
    }
}

?>