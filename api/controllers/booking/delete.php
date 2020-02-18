<?php
    // required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object file
include_once '../../config/database.php';
include_once '../../models/booking.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare booking object
$booking = new Booking($db);
 
// get booking id
$data = json_decode(file_get_contents("php://input"));
 
// set booking id to be deleted
$booking->id = $data->id;

// delete the booking
if($booking->delete()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "booking was deleted."));
}
 
// if unable to delete the booking
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to delete booking."));
}
?>