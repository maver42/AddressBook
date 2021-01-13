<?php
class Person {
    //DB conn
    private $conn;
    private $table = "myaddressbook"; //popravi v primeru drugačnega poimenovanja na lastnem serverju

    //person properties
    public $id;
    public $firstname;
    public $lastname;
    public $mail;
    public $phone;

    //Constructor with DB
    public function __construct($db){
        $this->conn = $db;
    }

    //GET all records
    public function read(){
        //query
        $query = 'SELECT * FROM ' . $this->table;
        //prepere query
        $stmt = $this->conn->prepare($query);
        //execute query
        $stmt->execute();

        return $stmt;
    }

    public function readById(){
        //query
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id= ?';
        //prepere query
        $stmt = $this->conn->prepare($query);

        //bind id
        $stmt->bindParam(1, $this->id);

        //execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->firstname = $row['firstname'];
        $this->lastname = $row['lastname'];
        $this->mail = $row['mail'];
        $this->phone = $row['phone'];

        return $stmt;
    }

    //Create new person
    public function create(){
        $query = 'INSERT INTO ' . $this->table . ' SET firstname = :firstname, lastname = :lastname, mail = :mail, phone = :phone';

        $stmt = $this->conn->prepare($query);

        //clean input
        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        $this->mail = htmlspecialchars(strip_tags($this->mail));
        $this->phone = htmlspecialchars(strip_tags($this->phone));

        //bind data
        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':lastname', $this->lastname);
        $stmt->bindParam(':mail', $this->mail);
        $stmt->bindParam(':phone', $this->phone);

        if($stmt->execute()) {
            return true;
        }

        //in case smth goes south
        printf("Error: %s. \n", $stmt->error);

        return false;
    }

    //Update new person
    public function update(){
        $query = 'UPDATE ' . $this->table . ' SET firstname = :firstname, lastname = :lastname, mail = :mail, phone = :phone WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        //clean input
        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        $this->mail = htmlspecialchars(strip_tags($this->mail));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->id = htmlspecialchars(strip_tags($this->id));

        //bind data
        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':lastname', $this->lastname);
        $stmt->bindParam(':mail', $this->mail);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        }

        //in case smth goes south
        printf("Error: %s. \n", $stmt->error);

        return false;
    }

    //delete person
    public function delete(){
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        //clean input
        $this->id = htmlspecialchars(strip_tags($this->id));

        //bind id
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        }

        //in case smth goes south
        printf("Error: %s. \n", $stmt->error);

        return false;
    }

}