<?php
include "../config.php";

$suppliers = $conn->query("SELECT Supplier_ID, Supplier_Name FROM supplier");
$error = "";

if (isset($_POST['submit'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $category = $conn->real_escape_string($_POST['category']);
    $supplier = $conn->real_escape_string($_POST['supplier']);

    if (empty($name) || empty($category) || empty($supplier)) {
        $error = "All fields are required!";
    } else {
        $insert = "INSERT INTO product (Product_Name, Category, Supplier_ID) VALUES ('$name', '$category', '$supplier')";
        if ($conn->query($insert)) {
            header("Location: view.php");
            exit();
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        body {
            background-color: #5c4033; /* dark brown */
            font-family: Arial, sans-serif;
            color: white;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            color: #fff;
        }

        .form-container {
            width: 400px;
            margin: 40px auto;
            padding: 20px;
            background-color: #8b5e3c; /* lighter brown */
            border-radius: 10px;
            box-shadow: 0 0 10px #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"], select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: none;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #5c4033;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #3b2a1f;
        }

        .error-message {
            color: #ff6666;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<h2>Add Product</h2>

<div class="form-container">
    <?php if ($error != "") { ?>
        <div class="error-message"><?= $error ?></div>
    <?php } ?>

    <form method="POST">
        <label>Product Name:</label>
        <input type="text" name="name" required>

        <label>Category:</label>
        <input type="text" name="category" required>

        <label>Supplier:</label>
        <select name="supplier" required>
            <option value="">-- Select Supplier --</option>
            <?php while ($row = $suppliers->fetch_assoc()) { ?>
                <option value="<?= $row['Supplier_ID'] ?>"><?= $row['Supplier_Name'] ?></option>
            <?php } ?>
        </select>

        <button type="submit" name="submit">Save</button>
    </form>
</div>

</body>
</html>
