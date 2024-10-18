<?php
class db {
    protected $connection;

    function setconnection() {
        try {
            // Establishing the connection to the database
            $this->connection = new PDO("mysql:host=localhost;dbname=library_2", "root", "");
            // echo "Connection Done";
        }
         catch (PDOException $e) {
            // Handling the exception and displaying an error message
            // echo "Connection failed: " . $e->getMessage();
            echo "Error";
        }
    }
}
