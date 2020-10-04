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
        if ($query->execute($data)) {
            return 'success';
        } else {
            return 'error';
        }
    }

    function getLogs() {
        $query = $this->db->query("SELECT * FROM $this->table");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
