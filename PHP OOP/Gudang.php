<?php
class Gudang {
    private $conn;
    private $table_name = "gudang";

    public $id;
    public $name;
    public $location;
    public $capacity;
    public $status;
    public $opening_hour;
    public $closing_hour;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, location=:location, capacity=:capacity, status=:status, opening_hour=:opening_hour, closing_hour=:closing_hour";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":location", $this->location);
        $stmt->bindParam(":capacity", $this->capacity);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":opening_hour", $this->opening_hour);
        $stmt->bindParam(":closing_hour", $this->closing_hour);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function readSingle() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
        $this->location = $row['location'];
        $this->capacity = $row['capacity'];
        $this->status = $row['status'];
        $this->opening_hour = $row['opening_hour'];
        $this->closing_hour = $row['closing_hour'];
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET name=:name, location=:location, capacity=:capacity, status=:status, opening_hour=:opening_hour, closing_hour=:closing_hour WHERE id=:id";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":location", $this->location);
        $stmt->bindParam(":capacity", $this->capacity);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":opening_hour", $this->opening_hour);
        $stmt->bindParam(":closing_hour", $this->closing_hour);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function readWithPagination($limit, $offset) {
        $query = "SELECT * FROM " . $this->table_name . " LIMIT ? OFFSET ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $limit, PDO::PARAM_INT);
        $stmt->bindParam(2, $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    public function count() {
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name;
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_rows'];
    }
}
?>
