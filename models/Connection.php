<?php

class Connection
{
    function connect()
    {
        if (isset($_ENV['JAWSDB_URL'])) {
            $link = new PDO(
                "mysql:host=rnr56s6e2uk326pj.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=nqbm92ewjv9oqm14",
                "st8kgrqw37r08zwn",
                "j3csfl00p3xnxan6"
            );
            $link->exec("set names utf8");
            return $link;
        } else {
            $link = new PDO("mysql:host=localhost;dbname=contactrace", "root", "");
            $link->exec("set names utf8");
            return $link;
        }
    }
}
