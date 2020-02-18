<?php
    // This class will be used to read, add, edit and delete the rooms of the hotel
    class Employee{
     
        // database connection and table name
        private $conn;
        private $table_name = "employees";
     
        // object properties
        public $id;
        public $name;
        public $surname;
        public $username;
        public $password;
        public $roleId;
        public $salary;
        public $status;

        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }
    
        // read rooms
        public function read(){
    
            // select all query
            $query = "SELECT * FROM $this->table_name";
            // $query = "SELECT * FROM rooms";
        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
        
            // execute query
            $stmt->execute();
    
            return $stmt;
        }
    
        // create room
        public function create(){
        
            // query to insert record
            $query = "INSERT INTO $this->table_name
                    SET
                        Name=:name, Surname=:surname, Username=:username, Password=:password, RoleId=:roleId, Salary=:salary, Status=:status";
    
            // prepare query
            $stmt = $this->conn->prepare($query);
       
            // sanitize
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->surname=htmlspecialchars(strip_tags($this->surname));
            $this->username=htmlspecialchars(strip_tags($this->username));
            $this->password=htmlspecialchars(strip_tags($this->password));
            $this->roleId=htmlspecialchars(strip_tags($this->roleId));
            $this->salary=htmlspecialchars(strip_tags($this->salary));
            $this->status=htmlspecialchars(strip_tags($this->status));
        
            // bind values
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":surname", $this->surname);
            $stmt->bindParam(":username", $this->username);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":roleId", $this->roleId);
            $stmt->bindParam(":salary", $this->salary);
            $stmt->bindParam(":status", $this->status, PDO::PARAM_INT);
        
            // execute query
            if($stmt->execute()){
                return true;
            }
        
            return false;
            
        }
    
        // used when filling up the update room form
        public function readOne(){
            // query to read single record
                $query = "SELECT * FROM $this->table_name 
                WHERE Id = ?
                LIMIT
                0,1";
    
            // prepare query statement
            $stmt = $this->conn->prepare( $query );
    
            // bind id of room to be updated
            $stmt->bindParam(1, $this->id);
    
            // execute query
            $stmt->execute();
    
            // get retrieved row
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // set values to object properties
            $this->name = $row['Name'];
            $this->surname = $row['Surname'];
            $this->username = $row['Username'];
            $this->password = $row['Password'];
            $this->roleId = $row['RoleId'];
            $this->salary = $row['Salary'];
            $this->status = $row['Status'];
        }
    
        // update the employee
        public function update(){
        
            // update query
            $query = "UPDATE $this->table_name 
                    SET Name=:name, Surname=:surname, Username=:username, Password=:password, RoleId=:roleId, Salary=:salary, Status=:status
                    WHERE Id = :id";
        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
        


            // sanitize
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->surname=htmlspecialchars(strip_tags($this->surname));
            $this->username=htmlspecialchars(strip_tags($this->username));
            $this->password=htmlspecialchars(strip_tags($this->password));
            $this->roleId=htmlspecialchars(strip_tags($this->roleId));
            $this->salary=htmlspecialchars(strip_tags($this->salary));
            $this->status=htmlspecialchars(strip_tags($this->status));
            $this->id=htmlspecialchars(strip_tags($this->id));

        
            // bind values
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":surname", $this->surname);
            $stmt->bindParam(":username", $this->username);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":roleId", $this->roleId);
            $stmt->bindParam(":salary", $this->salary);
            $stmt->bindParam(":status", $this->status, PDO::PARAM_INT);
            $stmt->bindParam(':id', $this->id);

            // execute the query
            if($stmt->execute()){
                return true;
            }
        
            return false;
        }
    
        // delete the room
        public function delete(){
        
            // delete query
            $query = "DELETE FROM $this->table_name WHERE id = ?";
        
            // prepare query
            $stmt = $this->conn->prepare($query);
        
            // sanitize
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind id of record to delete
            $stmt->bindParam(1, $this->id);
        
            // execute query
            if($stmt->execute()){
                return true;
            }
        
            return false;
            
        }
    }
?>