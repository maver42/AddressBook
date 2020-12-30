<?php
class Database{
    //DB properties
    private $host = 'localhost';
    private $db_name = 'mydatabase'; //popravi v primeru drugačnega poimenovanja na lastnem serverju
    private $username = 'user'; //popravi v primeru drugačnega poimenovanja na lastnem serverju
    private $password = 'password'; //popravi v primeru drugačnega poimenovanja na lastnem serverju
    private $conn;

    //DB Connect
    public function connect() {
        $this->conn = null;

        try{
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }
}