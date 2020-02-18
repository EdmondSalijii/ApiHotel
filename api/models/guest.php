<?php
    // This class will be used to read, add, edit and delete the rooms of the hotel
    class Guest{
     
        // database connection and table name
        private $conn;
        private $table_name = "guests";
     
        // object properties
        public $id;
        public $name;
        public $surname;
        public $username;
        public $phoneNumber;
        public $address;
        public $city;
        public $country;
        public $personalId;

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
    
        // create guest
        public function create(){
        
            // query to insert record
            $query = "INSERT INTO $this->table_name
                    SET
                        Name=:name, Surname=:surname, Username=:username, PhoneNumber=:phoneNumber, Address=:address, City=:city, Country=:country, PersonalID=:personalId";
    
            // prepare query
            $stmt = $this->conn->prepare($query);
       
            // sanitize
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->surname=htmlspecialchars(strip_tags($this->surname));
            $this->username=htmlspecialchars(strip_tags($this->username));
            $this->phoneNumber=htmlspecialchars(strip_tags($this->phoneNumber));
            $this->address=htmlspecialchars(strip_tags($this->address));
            $this->city=htmlspecialchars(strip_tags($this->city));
            $this->country=htmlspecialchars(strip_tags($this->country));
            $this->personalId=htmlspecialchars(strip_tags($this->personalId));
        
            // bind values
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":surname", $this->surname);
            $stmt->bindParam(":username", $this->username);
            $stmt->bindParam(":phoneNumber", $this->phoneNumber);
            $stmt->bindParam(":address", $this->address);
            $stmt->bindParam(":city", $this->city);
            $stmt->bindParam(":country", $this->country);
            $stmt->bindParam(":personalId", $this->personalId);
        
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
    
            // bind id of guest to be updated
            $stmt->bindParam(1, $this->id);
    
            // execute query
            $stmt->execute();
    
            // get retrieved row
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // set values to object properties
            $this->name = $row['Name'];
            $this->surname = $row['Surname'];
            $this->username = $row['Username'];
            $this->phoneNumber = $row['PhoneNumber'];
            $this->address = $row['Address'];
            $this->city = $row['City'];
            $this->country = $row['Country'];
            $this->personalId = $row['PersonalID'];
        }
    
        // update the employee
        public function update(){
        
            // update query
            $query = "UPDATE $this->table_name 
                    SET Name=:name, Surname=:surname, Username=:username, PhoneNumber=:phoneNumber, Address=:address, City=:city, Country=:country, PersonalID=:personalId
                    WHERE Id = :id";
        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
        
            // sanitize
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->surname=htmlspecialchars(strip_tags($this->surname));
            $this->username=htmlspecialchars(strip_tags($this->username));
            $this->phoneNumber=htmlspecialchars(strip_tags($this->phoneNumber));
            $this->address=htmlspecialchars(strip_tags($this->address));
            $this->city=htmlspecialchars(strip_tags($this->city));
            $this->country=htmlspecialchars(strip_tags($this->country));
            $this->personalId=htmlspecialchars(strip_tags($this->personalId));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind values
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":surname", $this->surname);
            $stmt->bindParam(":username", $this->username);
            $stmt->bindParam(":phoneNumber", $this->phoneNumber);
            $stmt->bindParam(":address", $this->address);
            $stmt->bindParam(":city", $this->city);
            $stmt->bindParam(":country", $this->country);
            $stmt->bindParam(":personalId", $this->personalId);
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