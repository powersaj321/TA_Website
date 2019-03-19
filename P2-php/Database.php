<?php

/**
 * Provides access to the underlying PostgreSQL database.
 */
class Database {

    public static function open() {
        $host = "host=talab.ch5uqtluldkv.us-east-1.rds.amazonaws.com";
        $port = "port=5432";
        $db = "dbname=TALab";
        $user = "user=boylesjf";
        $pass = "password=110324012";

        $con = pg_connect("$host $port $db $user $pass");
        if (!$con) {
            echo "Error: unable to open database\n";
        }
        
        return $con;
    }

}
