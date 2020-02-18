<?php
    // This class will be used to read, add, edit and delete a booking
    class Booking{
     
        // database connection and table name
        private $conn;
        private $table_name = "booking";
     
        // object properties
        public $id;
        public $startDate;
        public $endDate;
        public $roomId;
        public $guestId;
        public $addedBy;
        public $price;

        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }
    
        // read bookings
        public function read(){
    
            // select all query
            $query = "SELECT * FROM $this->table_name";
        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
        
            // execute query
            $stmt->execute();
    
            return $stmt;
        }
    
        // create booking
        public function create(){
        
            // query to insert record
            $query = "INSERT INTO $this->table_name
                    SET
                        StartDate=:startDate, EndDate=:endDate, RoomId=:roomId, GuestId=:guestId, AddedBy=:addedBy, Price=:price";
    
            // prepare query
            $stmt = $this->conn->prepare($query);

            // sanitize
            $this->startDate=htmlspecialchars(strip_tags($this->startDate));
            $this->endDate=htmlspecialchars(strip_tags($this->endDate));
            $this->roomId=htmlspecialchars(strip_tags($this->roomId));
            $this->guestId=htmlspecialchars(strip_tags($this->guestId));
            $this->addedBy=htmlspecialchars(strip_tags($this->addedBy));
            $this->price=htmlspecialchars(strip_tags($this->price));
        
            // bind values
            $stmt->bindParam(":startDate", $this->startDate);
            $stmt->bindParam(":endDate", $this->endDate);
            $stmt->bindParam(":roomId", $this->roomId);
            $stmt->bindParam(":guestId", $this->guestId);
            $stmt->bindParam(":addedBy", $this->addedBy);
            $stmt->bindParam(":price", $this->price);
        
            // execute query
            if($stmt->execute()){
                return true;
            }
        
            return false;
            
        }
    
        // read one booking
        public function readOne(){
            // query to read single record
                $query = "SELECT * FROM $this->table_name 
                WHERE Id = ?
                LIMIT
                0,1";
    
            // prepare query statement
            $stmt = $this->conn->prepare( $query );
    
            // bind id of booking to be updated
            $stmt->bindParam(1, $this->id);
    
            // execute query
            $stmt->execute();
    
            // get retrieved row
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // set values to object properties
            $this->startDate = $row['StartDate'];
            $this->endDate = $row['EndDate'];
            $this->roomId = $row['RoomId'];
            $this->guestId = $row['GuestId'];
            $this->addedBy = $row['AddedBy'];
            $this->price = $row['Price'];
        }
    
        // update the booking
        public function update(){
        
            // update query
            $query = "UPDATE $this->table_name 
                    SET StartDate=:startDate, EndDate=:endDate, RoomId=:roomId, GuestId=:guestId, AddedBy=:addedBy, Price=:price
                    WHERE Id = :id";
        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
                    
            // sanitize
            $this->startDate=htmlspecialchars(strip_tags($this->startDate));
            $this->endDate=htmlspecialchars(strip_tags($this->endDate));
            $this->roomId=htmlspecialchars(strip_tags($this->roomId));
            $this->guestId=htmlspecialchars(strip_tags($this->guestId));
            $this->addedBy=htmlspecialchars(strip_tags($this->addedBy));
            $this->price=htmlspecialchars(strip_tags($this->price));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind values
            $stmt->bindParam(":startDate", $this->startDate);
            $stmt->bindParam(":endDate", $this->endDate);
            $stmt->bindParam(":roomId", $this->roomId);
            $stmt->bindParam(":guestId", $this->guestId);
            $stmt->bindParam(":addedBy", $this->addedBy);
            $stmt->bindParam(":price", $this->price);
            $stmt->bindParam(':id', $this->id);

            // execute the query
            if($stmt->execute()){
                return true;
            }
        
            return false;
        }
    
        // delete the booking
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