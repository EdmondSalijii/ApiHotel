<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../../config/database.php';
 
// instantiate guest object
include_once '../../models/guest.php';
 
$database = new Database();
$db = $database->getConnection();
 
$guest = new Guest($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));

if(
    isset($data->name) &&
    isset($data->surname) &&
    isset($data->username) &&
    isset($data->phoneNumber) &&
    isset($data->address)&&
    isset($data->city)&&
    isset($data->country)&&
    isset($data->personalId)
){
    // set guest property values
    $guest->name = $data->name;
    $guest->surname = $data->surname;
    $guest->username = $data->username;
    $guest->phoneNumber = $data->phoneNumber;
    $guest->address = $data->address;
    $guest->city = $data->city;
    $guest->country = $data->country;
    $guest->personalId = $data->personalId;
 
    // create the guest
    if($guest->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Guest was created."));
    }
 
    // if unable to create the guest, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create guest."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create guest. Data is incomplete."));
}
?>