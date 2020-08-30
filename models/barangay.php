<?php

namespace models;
use PDO;

class Barangay {
    public static function addBarangay($table, $data) {
        $stmt = Connection::connect()->prepare(
            "INSERT INTO $table(bname, latitude, longitude, idcm, remarks)
            VALUES (:bname, :latitude, :longitude, :idcm, :remarks)"
        );

        $stmt->bindParam(":bname", $data['bname'], PDO::PARAM_STR);
        $stmt->bindParam(":latitude", $data['latitude'], PDO::PARAM_STR);
        $stmt->bindParam(":longitude", $data['longitude'], PDO::PARAM_STR);
        $stmt->bindParam(":idcm", $data['idcm'], PDO::PARAM_STR);
        $stmt->bindParam(":remarks", $data['remarks'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }
        // $stmt->close();
        $stmt = null;
    }
}

?>