<?php
include_once 'config.php';
include_once 'Gudang.php';

$database = new Database();
$db = $database->getConnection();

$gudang = new Gudang($db);

$gudang->name = $_POST['name'];
$gudang->location = $_POST['location'];
$gudang->capacity = $_POST['capacity'];
$gudang->status = $_POST['status'];
$gudang->opening_hour = $_POST['opening_hour'];
$gudang->closing_hour = $_POST['closing_hour'];

if ($gudang->create()) {
    header("Location: index.php");
} else {
    echo "Error adding warehouse.";
}
?>
