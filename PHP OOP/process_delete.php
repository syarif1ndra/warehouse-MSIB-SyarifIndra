<?php
include_once 'config.php';
include_once 'Gudang.php';

$database = new Database();
$db = $database->getConnection();

$gudang = new Gudang($db);
$gudang->id = $_GET['id'];

if ($gudang->delete()) {
    header("Location: index.php");
} else {
    echo "Error deleting warehouse.";
}
?>
