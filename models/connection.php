<?php

namespace models;
use PDO;

class Connection {
    static public function connect() {
        $link = new PDO("mysql:host=localhost;dbname=contactrace", "root", "");
		$link -> exec("set names utf8");
		return $link;
    }
}