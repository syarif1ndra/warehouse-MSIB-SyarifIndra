<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Warehouse</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            margin: 50px auto;
            width: 50%;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input[type="text"], input[type="number"], input[type="time"], select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .back-button {
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Add New Warehouse</h2>
    <form action="process_create.php" method="POST">
        <label for="name">Warehouse Name:</label>
        <input type="text" name="name" required>

        <label for="location">Location:</label>
        <input type="text" name="location" required>

        <label for="capacity">Capacity:</label>
        <input type="number" name="capacity" required>

        <label for="status">Status:</label>
        <select name="status" required>
            <option value="aktif">Aktif</option>
            <option value="tidak_aktif">Tidak Aktif</option>
        </select>

        <label for="opening_hour">Opening Hour:</label>
        <input type="time" name="opening_hour" required>

        <label for="closing_hour">Closing Hour:</label>
        <input type="time" name="closing_hour" required>

        <button type="submit">Add Warehouse</button>
    </form>
    <a href="index.php" class="back-button">Back to Warehouse List</a>
</div>

</body>
</html>
