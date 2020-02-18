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
include_once '../../models/employee.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare employee object
$employee = new Employee($db);
 
// get id of employee to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of employee to be edited
$employee->id = $data->id;
 
$hashedPsw = md5($data->password);
// set employee property values
$employee->name = $data->name;
$employee->surname = $data->surname;
$employee->username = $data->username;
$employee->password = $hashedPsw;
$employee->roleId = $data->roleId;
$employee->salary = $data->salary;
$employee->status = $data->status;
 
// update the employee
if($employee->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "employee was updated."));
}
 
// if unable to update the employee, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update employee."));
}
?>