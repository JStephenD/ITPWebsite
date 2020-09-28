<?php   
class CityMunicipality {
    function __construct($db) {
        $this->db = $db;
    }

    function addCityMunicipality($table, $data) {
        $query = $this->db->prepare(
            "INSERT INTO $table(cmdesc, latitude, longitude, cmclass, remarks)
            VALUES (:cmdesc, :latitude, :longitude, :cmclass, :remarks)"
        );
        $query->execute($data);
        $query = null;
    }

    function getCityMunicipalities($table, $id = null, $cmdesc = null) {
        if (isset($cmdesc)) {
            $query = $this->db->prepare(
                "SELECT * FROM $table WHERE cmdesc = :cmdesc"
            );
            $query->execute(['cmdesc' => $cmdesc]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } else if (isset($id)) {
            $query = $this->db->prepare(
                "SELECT * FROM $table WHERE id = :id"
            );
            $query->bindParam(':id', $id, PDO::PARAM_STR);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } else {
            $query = $this->db->query(
                "SELECT * FROM $table ORDER BY cmdesc"
            );
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    function updateCityMunicipality($table, $data) {
        $query = $this->db->prepare(
            "UPDATE $table SET 
                cmdesc = :cmdesc,  
                latitude = :latitude,
                longitude = :longitude,
                cmclass = :cmclass,
                remarks = :remarks
            WHERE id = :id"
        );
        $query->execute($data);
    }

    function deleteCityMunicipality($table, $data) {
        $query = $this->db->prepare(
            "DELETE FROM $table WHERE id = :id"
        );
        $query->execute($data);
    }

    function getCities($table)
    {
        $query = $this->db->query(
            "SELECT * FROM $table WHERE cmclass = 'City' ORDER BY cmdesc"
        );
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function getMunicipalities($table)
    {
        $query = $this->db->query(
            "SELECT * FROM $table WHERE cmclass = 'Municipality' ORDER BY cmdesc"
        );
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>