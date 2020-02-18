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
include_once '../../models/room.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare room object
$room = new Room($db);
 
// get id of room to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of room to be edited
$room->id = $data->id;
 
// set room property values
$room->roomNumber = $data->roomNumber;
$room->floor = $data->floor;
$room->people = $data->people;
$room->price = $data->price;
$room->isAvailable = $data->isAvailable;
 
// update the room
if($room->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "room was updated."));
}
 
// if unable to update the room, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update room."));
}
?>