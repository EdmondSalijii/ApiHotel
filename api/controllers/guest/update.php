<?php

?><?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../../config/database.php';
include_once '../../models/guest.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare guest object
$guest = new Guest($db);
 
// get id of guest to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of guest to be edited
$guest->id = $data->id;
 
// set guest property values
$guest->name = $data->name;
$guest->surname = $data->surname;
$guest->username = $data->username;
$guest->phoneNumber = $data->phoneNumber;
$guest->address = $data->address;
$guest->city = $data->city;
$guest->country = $data->country;
$guest->personalId = $data->personalId;
 
// update the guest
if($guest->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "guest was updated."));
}
 
// if unable to update the guest, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update guest."));
}
?>