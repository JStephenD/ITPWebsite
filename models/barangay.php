<?php

namespace models;
use PDO;

class Barangay {
    public static function addBarangay($table, $data) {
        $query = Connection::connect()->prepare(
            "INSERT INTO 
            $table(
                bname, 
                blevel,
                estpop,
                latitude, 
                longitude, 
                idcm, 
                remarks
            )
            VALUES
            (
                :bname, 
                :blevel,
                :estpop,
                :latitude, 
                :longitude, 
                :idcm, 
                :remarks
            )"
        );
        $query->execute($data);
        $query = null;
    }

    public static function getBarangays($table, $id=null) {
        if (isset($id)) {
            $query = Connection::connect()->prepare(
                "SELECT * FROM $table WHERE id = :id"
            );
            $query->bindParam(':id', $id, PDO::PARAM_STR);
            $query->execute();
            return $query->fetch();

            $query = null;

        } else {
            $result = Connection::connect()->query(
                "SELECT * FROM $table"
            );
            return $result->fetchAll();
        }
    }

    public static function updateBarangay($table, $data) {
        $query = Connection::connect()->prepare(
            "UPDATE $table SET 
                bname = :bname,  
                estpop = :estpop,
                blevel = :blevel,
                latitude = :latitude,
                longitude = :longitude,
                idcm = :idcm,
                remarks = :remarks
            WHERE id = :id"
        );
        $query->execute($data);
    }

    public static function deleteBarangay($table, $data) {
        $query = Connection::connect()->prepare(
            "DELETE FROM $table WHERE id = :id"
        );
        $query->execute($data);
    }
}

?>