<?php
include 'db.php';

$sql = "SELECT * FROM Products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product List</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #e9ecef;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 900px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            color: #343a40;
            font-size: 2em;
            text-align: center;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 0.9em;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }
        th {
            background-color: #007bff;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        tr {
            transition: background-color 0.3s;
        }
        tr:hover {
            background-color: #f8f9fa;
        }
        a {
            color: #007bff;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
            font-size: 0.9em;
            display: inline-block;
        }
        a:hover {
            background-color: #0056b3;
            color: #fff;
        }
        .btn-add {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            text-align: center;
            display: block;
            width: 150px;
            margin: 20px auto;
            border-radius: 50px;
            font-weight: bold;
            text-transform: uppercase;
            transition: background-color 0.3s;
        }
        .btn-add:hover {
            background-color: #218838;
        }
        .btn-edit {
            background-color: #ffc107;
            color: white;
            padding: 6px 10px;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
            padding: 6px 10px;
        }
        .actions a {
            margin-right: 10px;
            text-transform: uppercase;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Product List</h1>
        <a href="create.php" class="btn-add">Add New Product</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>BarCode</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['ID']; ?></td>
                        <td><?php echo $row['Name']; ?></td>
                        <td><?php echo $row['Description']; ?></td>
                        <td><?php echo $row['Price']; ?></td>
                        <td><?php echo $row['BarCode']; ?></td>
                        <td><?php echo $row['Created_at']; ?></td>
                        <td><?php echo $row['Updated_at']; ?></td>
                        <td class="actions">
                            <a href="update.php?id=<?php echo $row['ID']; ?>" class="btn-edit">Edit</a>
                            <a href="delete.php?id=<?php echo $row['ID']; ?>" class="btn-delete" onclick="return confirm('Are you sure?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">No products found</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
