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

    // Fungsi untuk menampilkan semua gudang
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Fungsi untuk menambah gudang baru
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, location=:location, capacity=:capacity, status=:status, opening_hour=:opening_hour, closing_hour=:closing_hour";
        
        $stmt = $this->conn->prepare($query);

        // Binding data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":location", $this->location);
        $stmt->bindParam(":capacity", $this->capacity);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":opening_hour", $this->opening_hour);
        $stmt->bindParam(":closing_hour", $this->closing_hour);

        // Eksekusi query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Fungsi untuk menampilkan data gudang berdasarkan ID
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

    // Fungsi untuk mengupdate data gudang
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET name=:name, location=:location, capacity=:capacity, status=:status, opening_hour=:opening_hour, closing_hour=:closing_hour WHERE id=:id";
        
        $stmt = $this->conn->prepare($query);

        // Binding data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":location", $this->location);
        $stmt->bindParam(":capacity", $this->capacity);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":opening_hour", $this->opening_hour);
        $stmt->bindParam(":closing_hour", $this->closing_hour);
        $stmt->bindParam(":id", $this->id);

        // Eksekusi query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Fungsi untuk menghapus atau menonaktifkan gudang
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Fungsi untuk menampilkan gudang dengan pagination
    public function readWithPagination($limit, $offset) {
        $query = "SELECT * FROM " . $this->table_name . " LIMIT ? OFFSET ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $limit, PDO::PARAM_INT);
        $stmt->bindParam(2, $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    // Fungsi untuk menghitung total data gudang
    public function count() {
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name;
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_rows'];
    }
}
?>
