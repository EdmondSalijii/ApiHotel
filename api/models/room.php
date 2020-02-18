<?php
// This class will be used to read, add, edit and delete the rooms of the hotel
class Room{
 
    // database connection and table name
    private $conn;
    private $table_name = "rooms";
 
    // object properties
    public $id;
    public $roomNumber;
    public $floor;
    public $people;
    public $price;
    public $isAvailable;
 
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
                    RoomNumber=:roomNumber, Floor=:floor, People=:people, Price=:price, IsAvailable=:isAvailable";

        // prepare query
        $stmt = $this->conn->prepare($query);
   
        // sanitize
        $this->roomNumber=htmlspecialchars(strip_tags($this->roomNumber));
        $this->floor=htmlspecialchars(strip_tags($this->floor));
        $this->people=htmlspecialchars(strip_tags($this->people));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->isAvailable=htmlspecialchars(strip_tags($this->isAvailable));
    
        // bind values
        $stmt->bindParam(":roomNumber", $this->roomNumber);
        $stmt->bindParam(":floor", $this->floor);
        $stmt->bindParam(":people", $this->people);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":isAvailable", $this->isAvailable, PDO::PARAM_INT);
    
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
        $this->roomNumber = $row['RoomNumber'];
        $this->floor = $row['Floor'];
        $this->people = $row['People'];
        $this->price = $row['Price'];
        $this->isAvailable = $row['IsAvailable'];
    }

    // update the room
    public function update(){
    
        // update query
        $query = "UPDATE $this->table_name 
                SET RoomNumber=:roomNumber, Floor=:floor, People=:people, Price=:price, IsAvailable=:isAvailable
                WHERE Id = :id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->roomNumber=htmlspecialchars(strip_tags($this->roomNumber));
        $this->floor=htmlspecialchars(strip_tags($this->floor));
        $this->people=htmlspecialchars(strip_tags($this->people));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->isAvailable=htmlspecialchars(strip_tags($this->isAvailable));
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind new values
        $stmt->bindParam(":roomNumber", $this->roomNumber);
        $stmt->bindParam(":floor", $this->floor);
        $stmt->bindParam(":people", $this->people);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":isAvailable", $this->isAvailable);
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