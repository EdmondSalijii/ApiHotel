<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../../config/database.php';
 
// instantiate room object
include_once '../../models/room.php';
 
$database = new Database();
$db = $database->getConnection();
 
$room = new Room($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));

if(
    // !empty($data->Id) &&
    isset($data->roomNumber) &&
    isset($data->floor) &&
    isset($data->people) &&
    isset($data->price) &&
    isset($data->isAvailable)
){
 
    // set room property values
    $room->roomNumber = $data->roomNumber;
    $room->floor = $data->floor;
    $room->people = $data->people;
    $room->price = $data->price;
    $room->isAvailable = $data->isAvailable;
 
    // create the room
    if($room->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Room was created."));
    }
 
    // if unable to create the room, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create room."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create room. Data is incomplete."));
}
?>