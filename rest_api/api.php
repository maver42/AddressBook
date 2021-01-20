<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once 'config/Database.php';
include_once 'models/Person.php';

// instanca DB
$database = new Database();
$db = $database->connect();

// instanca person
$person = new Person($db);

$Method = (isset($_SERVER['REQUEST_METHOD'])) ? $_SERVER['REQUEST_METHOD'] : null;
// var_dump ($_SERVER['REQUEST_METHOD']);


//--------------------------------------------------------------
//   GET ALL
//--------------------------------------------------------------
if ($Method == 'GET') {
    if (!isset($_GET['id'])) { // ne sme bit vpisan id
        // person query
        $result = $person->read();
        // row count (number of persons in DB)
        $num = $result->rowCount();


        if ($num > 0) {
            //person array
            $people = array();
            $people = array();

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
                array_push($people, $person_col);
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
    if (isset($_GET['id']) && $_GET['id'] != null) {

        $person->id = $_GET['id'];

        $person->readById();

        $person_arr = array(
            'id' => $person->id,
            'firstname' => $person->firstname,
            'lastname' => $person->lastname,
            'mail' => $person->mail,
            'phone' => $person->phone,
        );

        //make json
        print_r(json_encode($person_arr));
    } else {
        //id ni vpisan
        die();
    }
}


//--------------------------------------------------------------
//  POST
//--------------------------------------------------------------
if ($Method == 'POST') {
    //get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $person->firstname = $data->firstname;
    $person->lastname = $data->lastname;
    $person->mail = $data->mail;
    $person->phone = $data->phone;

    if ($person->firstname != null && $person->lastname != null && $person->mail != null && $person->phone != null) {
        //create person
        if ($person->create()) {
            echo json_encode(
                array('message' => 'Person created')
            );
        } else {
            echo json_encode(
                array('message' => 'Person not created')
            );
        }
    } else {
        //ni vseh podatkov
        echo json_encode(
            array('message' => 'Incomplete data')
        );
        die();
    }
}


//--------------------------------------------------------------
//  PUT
//--------------------------------------------------------------
if ($Method == 'PUT') {

    //get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    if(!isset($data->id)){
        echo json_encode(
            array('message' => 'Error ID missing')
        );
        die();
    }

    //set ID to update
    $person->id = $data->id;

    //najdi prejsnje vrednosti
    $person->readById();

    //ce so vrednosti podane jih posodobi, drugace obdrzi stare
    $person->firstname = isset($data->firstname) ?  $data->firstname : $person->firstname;
    $person->lastname = isset($data->lastname) ? $data->lastname : $person->lastname;
    $person->mail = isset($data->mail) ? $data->mail : $person->mail;
    $person->phone = isset($data->phone) ? $data->phone:  $person->phone;

    //update person
    if ($person->update()) {
        echo json_encode(
            array('message' => 'Person updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Person not updated')
        );
    }
}


//--------------------------------------------------------------
//  DELETE
//--------------------------------------------------------------
if ($Method == 'DELETE') {
    //get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    //set ID to update
    $person->id = $data->id;


    //delete person
    if ($person->delete()) {
        echo json_encode(
            array('message' => 'Person deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Person not deleted')
        );
    }
}
