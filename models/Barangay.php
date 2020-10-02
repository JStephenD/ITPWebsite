<?php

class Barangay {
    function __construct($db) {
        $this->db = $db;
    }

    function addBarangay($table, $data) {
        $query = $this->db->prepare(
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

    function getBarangays($table, $id = null, $idcm = null) {
        if (isset($idcm)) {
            $query = $this->db->prepare(
                "SELECT * FROM $table WHERE idcm = :idcm"
            );
            $query->execute(['idcm' => $idcm]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } else if (isset($id)) {
            $query = $this->db->prepare(
                "SELECT * FROM $table WHERE id = :id"
            );
            $query->execute(['id' => $id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } else {
            $result = $this->db->query(
                "SELECT * FROM $table ORDER BY bname"
            );
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    function updateBarangay($table, $data) {
        $query = $this->db->prepare(
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

    function deleteBarangay($table, $data) {
        $query = $this->db->prepare(
            "DELETE FROM $table WHERE id = :id"
        );
        $query->execute($data);
    }
}

?>