<?php
class Person {
    //DB conn
    private $conn;
    private $table = "myaddressbook";

    //person properties
    public $id;
    public $firstName;
    public $lastName;
    public $mail;
    public $phone;

    //Constructor with DB
    public function __construct($db){
        $this->conn = $db;
    }

    //GET perople
    public function read(){
        //query
        $query = 'SELECT * FROM ' . $this->table;
        //prepere query
        $stmt = $this->conn->prepare($query);
        //execute query
        $stmt->execute();

        return $stmt;
    }

}