<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../../config/database.php';
include_once '../../models/guest.php';
 
// instantiate database and guest object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$guest = new Guest($db);
 
// query guests
$stmt = $guest->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
 
    // guests array
    $guests_arr=array();
    $guests_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $guest_item=array(
            "id" => $Id,
            "name" => $Name,
            "surname" => $Surname,
            "username" => $Username,
            "phoneNumber" => $PhoneNumber,
            "address" => $Address,
            "city" => $City,
            "country" => $Country,
            "personalId" => $PersonalID
        );

        array_push($guests_arr["records"], $guest_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show employees data in json format
    echo json_encode($guests_arr);
}else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no employees found
    echo json_encode(
        array("message" => "No guests found.")
    );
}