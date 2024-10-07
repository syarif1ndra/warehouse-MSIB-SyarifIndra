<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warehouse Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 15px 0;
            text-align: center;
        }
        .container {
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        table th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .add-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .pagination {
            margin: 20px 0;
            text-align: center;
        }
        .pagination a {
            color: #4CAF50;
            padding: 8px 16px;
            text-decoration: none;
            border: 1px solid #ddd;
            margin: 0 5px;
        }
        .pagination a.active {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>

<header>
    <h1>Warehouse Management System</h1>
</header>

<div class="container">
    <a href="create.php" class="add-button">+ Add New Warehouse</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Location</th>
            <th>Capacity</th>
            <th>Status</th>
            <th>Opening Hour</th>
            <th>Closing Hour</th>
            <th>Actions</th>
        </tr>

        <?php
        include_once 'config.php';
        include_once 'Gudang.php';

        $database = new Database();
        $db = $database->getConnection();
        $gudang = new Gudang($db);

        $limit = 5; 
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $stmt = $gudang->read($limit, $offset);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['location']}</td>";
            echo "<td>{$row['capacity']}</td>";
            echo "<td>{$row['status']}</td>";
            echo "<td>{$row['opening_hour']}</td>";
            echo "<td>{$row['closing_hour']}</td>";
            echo "<td>
                    <a href='update.php?id={$row['id']}'>Edit</a> |
                    <a href='process_delete.php?id={$row['id']}'>Delete</a>
                  </td>";
            echo "</tr>";
        }

        $total_rows = $gudang->count();
        $total_pages = ceil($total_rows / $limit);
        ?>

    </table>

    <div class="pagination">
        <?php
        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<a href='index.php?page={$i}'" . ($i == $page ? " class='active'" : "") . ">{$i}</a>";
        }
        ?>
    </div>
</div>

</body>
</html>
