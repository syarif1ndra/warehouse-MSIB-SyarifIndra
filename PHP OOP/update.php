<?php
include_once 'config.php';
include_once 'Gudang.php';

$db = new Database();
$conn = $db->getConnection();

$gudang = new Gudang($conn);

$gudang->id = isset($_GET['id']) ? $_GET['id'] : die("ID tidak ditemukan.");

$gudang->readSingle();

if (!$gudang->name) {
    die("Data warehouse tidak ditemukan.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gudang->name = $_POST['name'];
    $gudang->location = $_POST['location'];
    $gudang->capacity = $_POST['capacity'];
    $gudang->status = $_POST['status'];
    $gudang->opening_hour = $_POST['opening_hour'];
    $gudang->closing_hour = $_POST['closing_hour'];

    if ($gudang->update()) {
        header("Location: index.php");
        exit(); 
    } else {
        echo "<div class='alert alert-danger'>Gagal memperbarui data warehouse.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Warehouse</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: white;
            padding: 30px;
        }
        h2 {
            text-align: center;
            color: #343a40;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Update Warehouse</h2>
    <form method="post" action="">
        <div class="form-group">
            <label for="name">Warehouse Name:</label>
            <input type="text" class="form-control" name="name" value="<?php echo isset($gudang->name) ? $gudang->name : ''; ?>" required>
        </div>

        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" class="form-control" name="location" value="<?php echo isset($gudang->location) ? $gudang->location : ''; ?>" required>
        </div>

        <div class="form-group">
            <label for="capacity">Capacity:</label>
            <input type="number" class="form-control" name="capacity" value="<?php echo isset($gudang->capacity) ? $gudang->capacity : ''; ?>" required>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" name="status" required>
                <option value="aktif" <?php echo (isset($gudang->status) && $gudang->status == 'aktif') ? 'selected' : ''; ?>>Aktif</option>
                <option value="tidak_aktif" <?php echo (isset($gudang->status) && $gudang->status == 'tidak_aktif') ? 'selected' : ''; ?>>Tidak Aktif</option>
            </select>
        </div>

        <div class="form-group">
            <label for="opening_hour">Opening Hour:</label>
            <input type="time" class="form-control" name="opening_hour" value="<?php echo isset($gudang->opening_hour) ? $gudang->opening_hour : ''; ?>" required>
        </div>

        <div class="form-group">
            <label for="closing_hour">Closing Hour:</label>
            <input type="time" class="form-control" name="closing_hour" value="<?php echo isset($gudang->closing_hour) ? $gudang->closing_hour : ''; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Update Warehouse</button>
        <a href="index.php" class="btn btn-secondary btn-block" style="margin-top: 10px;">Back to Warehouse List</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
