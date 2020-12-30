<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once '../config/Database.php';
include_once '../models/Person.php';

// instanca DB
$database = new Database();
$db = $database->connect();

// instanca person
$person = new Person($db);

//get raw posted data
$data = json_decode(file_get_contents("php://input"));

$person->firstname = $data->firstname;
$person->lastname = $data->lastname;
$person->mail = $data->mail;
$person->phone = $data->phone;

//create person
if($person->create()){
    echo json_encode(
        array('message' => 'Person created')
    );
} else {
    echo json_encode(
        array('message' => 'Person not created')
    );
}
