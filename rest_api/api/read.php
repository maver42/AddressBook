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

    // person query
    $result = $person->read();
    // row count (number of persons in DB)
    $num = $result->rowCount();
  

    if($num > 0){
        //person array
        $people = array();
        $people['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
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
        echo json_encode( array('message'=> 'No person found'));
    }
