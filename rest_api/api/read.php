<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../config/Database.php';
include_once '../models/Person.php';

// instanca DB
$database = new Database();
$db = $database->connect();

// instanca person
$person = new Person($db);

//--------------------------------------------------------------
//   GET ALL
//--------------------------------------------------------------
if (!isset($_GET['id'])) { // ne sme bit vpisan id
    // person query
    $result = $person->read();
    // row count (number of persons in DB)
    $num = $result->rowCount();


    if ($num > 0) {
        //person array
        $people = array();
        $people['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row); //zato da ne treba pisati $row['title']

            $person_col = array(
                'id' => $id,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'mail' => $mail,
                'phone' => $phone
            );

            //Push to "data
            array_push($people['data'], $person_col);
        }

        //convert to json
        echo json_encode($people);
    } else {
        echo json_encode(array('message' => 'No person found'));
    }
}

//--------------------------------------------------------------
//  GET SINGLE PERSON
//--------------------------------------------------------------
//get id for single person
if (isset($_GET['id']) && $_GET['id'] != null ) {
    
    $person->id = $_GET['id'];

    $person->readById();
    
    $person_arr = array(
        'id' => $person->id,
        'firstname' => $person->firstName,
        'lastname' => $person->lastName,
        'mail' => $person->mail,
        'phone' => $person->phone,
    );

    //make json
    print_r(json_encode($person_arr));
}
else{
    //id ni vpisan
    die();
}
