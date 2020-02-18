<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../../config/database.php';
include_once '../../models/room.php';
 
// instantiate database and room object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$room = new Room($db);
 
// query room
$stmt = $room->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
 
    // rooms array
    $rooms_arr=array();
    $rooms_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $room_item=array(
            "id" => $Id,
            "roomNumber" => $RoomNumber,
            "floor" => $Floor,
            "people" => $People,
            "price" => $Price,
            "isAvailable" => $IsAvailable
        );
 
        array_push($rooms_arr["records"], $room_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show rooms data in json format
    echo json_encode($rooms_arr);
}else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no rooms found
    echo json_encode(
        array("message" => "No rooms found.")
    );
}
 