<?php
// This API is used for creating a booking

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../../config/database.php';
 
// instantiate booking object
include_once '../../models/booking.php';
 
$database = new Database();
$db = $database->getConnection();
 
$booking = new Booking($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));

if(
    isset($data->startDate) &&
    isset($data->endDate) &&
    isset($data->roomId) &&
    isset($data->guestId) &&
    isset($data->addedBy)&&
    isset($data->price)
){

    // set booking property values
    $booking->startDate = $data->startDate;
    $booking->endDate = $data->endDate;
    $booking->roomId = $data->roomId;
    $booking->guestId = $data->guestId;
    $booking->addedBy = $data->addedBy;
    $booking->price = $data->price;
 
    // create the booking
    if($booking->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Booking was created."));
    }
 
    // if unable to create the booking, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create booking."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create booking. Data is incomplete."));
}
?>