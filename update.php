<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $barcode = $_POST['barcode']; // Capture the barcode

    $sql = "UPDATE Products SET Name=?, Description=?, Price=?, BarCode=? WHERE ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdsi", $name, $description, $price, $barcode, $id); // Add $barcode and adjust the parameter types

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM Products WHERE ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if (!$product) {
        die("Product not found");
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Product</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            color: #343a40;
            font-size: 2em;
            text-align: center;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            font-weight: bold;
            margin-bottom: 8px;
            color: #343a40;
        }
        input[type="text"],
        input[type="number"],
        textarea {
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ced4da;
            margin-bottom: 20px;
            font-size: 1em;
            width: 100%;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
            text-align: center;
        }
        a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Update Product</h1>
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $product['ID']; ?>">
            
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['Name']); ?>" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description"><?php echo htmlspecialchars($product['Description']); ?></textarea>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($product['Price']); ?>" step="0.01" required>

            <label for="barcode">BarCode:</label> <!-- Add this field for BarCode -->
            <input type="text" id="barcode" name="barcode" value="<?php echo htmlspecialchars($product['BarCode']); ?>" required>

            <input type="submit" value="Update Product">
        </form>
        <a href="index.php">Back to List</a>
    </div>
</body>
</html>
