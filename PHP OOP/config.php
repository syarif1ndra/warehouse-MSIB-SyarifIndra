<?php
class Database {
    private $host = "localhost";  // Nama host MySQL (localhost jika menggunakan XAMPP)
    private $db_name = "warehouse_msib";  // Nama database
    private $username = "root";  // Username MySQL (default XAMPP adalah root)
    private $password = "";  // Password MySQL (default XAMPP kosong)
    public $conn;

    // Fungsi koneksi ke database
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
