<?php

?><?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../../config/database.php';
include_once '../../models/guest.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare guest object
$guest = new Guest($db);
 
// set ID property of record to read
$guest->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of guest to be edited
$guest->readOne();
 
if($guest->username!=null){
    // create array
    $guest_arr = array(
        "id" =>  $guest->id,
        "name" => $guest->name,
        "surname" => $guest->surname,
        "username" => $guest->username,
        "phoneNumber" => $guest->phoneNumber,
        "address" => $guest->address,
        "city" => $guest->city,
        "country" => $guest->country,
        "personalId" => $guest->personalId
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($guest_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user guest does not exist
    echo json_encode(array("message" => "Guest does not exist."));
}
?>