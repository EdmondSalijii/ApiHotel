<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../../config/database.php';
 
// instantiate employees object
include_once '../../models/employee.php';
 
$database = new Database();
$db = $database->getConnection();
 
$employee = new Employee($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));

if(
    // !empty($data->Id) &&
    isset($data->name) &&
    isset($data->surname) &&
    isset($data->username) &&
    isset($data->password) &&
    isset($data->roleId)&&
    isset($data->salary)&&
    isset($data->status)
){
    // hash password with md5
    $hashedPsw = md5($data->password);
    // set employees property values
    // $employee->id = $data->Id;
    $employee->name = $data->name;
    $employee->surname = $data->surname;
    $employee->username = $data->username;
    $employee->password = $hashedPsw;
    $employee->roleId = $data->roleId;
    $employee->salary = $data->salary;
    $employee->status = $data->status;
 
    // create the employees
    if($employee->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Employee was created."));
    }
 
    // if unable to create the employees, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create employee."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create employee. Data is incomplete."));
}
?>