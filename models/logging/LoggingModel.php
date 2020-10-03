<?php

class LoggingModel {
    function __construct($db, $table = 'tracing_logging') {
        $this->db = $db;
        $this->table = $table;
    }

    function log($data) {
        $query = $this->db->prepare(
            "INSERT INTO 
                $this->table (
                    entry_type,
                    profile_id,
                    date,
                    time,
                    temp
                )
            VALUES (
                :entry_type,
                :profile_id,
                :date,
                :time,
                :temp
            )
            "
        );
        $query->execute($data);
    }

    function getLogs() {
        $query = $this->db->query("SELECT * FROM $this->table");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
