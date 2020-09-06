<?php
namespace models;
use PDO;

class User {
    public static function getUserByUsername($table, $data) {
        $query = Connection::connect()->prepare(
            "SELECT 
                id,
                username, 
                first_name, 
                last_name, 
                birthday 
            FROM $table 
            WHERE username = :username"
        );
        $query->execute(array('username'=>$data['username']));
        return $query->fetch();
    }

    public static function signUp($table, $data) {
        if (self::getUserByUsername($table, $data)) {
            return 'userAlreadyExists';
        }

        $query = Connection::connect()->prepare(
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

    public static function login($table, $data) {
        if (!self::getUserByUsername($table, $data)) {
            return 'userDoesNotExist';
        }

        $query = Connection::connect()->prepare(
            "SELECT 
                id,
                username, 
                first_name, 
                last_name, 
                birthday
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

    public static function updateAccount($table, $data) {
        $query = Connection::connect()->prepare(
            "UPDATE $table SET
                first_name = :first_name,
                last_name = :last_name,
                birthday = :birthday
            WHERE id = :id
            "
        );
        $query->execute($data);
    }

    public static function logout($table, $data) {
        $query = Connection::connect()->prepare(
            ""
        );
    }
}

?>