<?php

class Connection
{
    function connect()
    {
        if (isset($_ENV['CLEARDB_DATABASE_URL'])) {
        } else {
            $link = new PDO("mysql:host=localhost;dbname=contactrace", "root", "");
            $link->exec("set names utf8");
            return $link;
        }
    }
}
