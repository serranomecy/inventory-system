<?php
include "../config.php";

if (!isset($_GET['id'])) { header("Location: view.php"); exit(); }
$id = $_GET['id'];
$product = $conn->query("SELECT * FROM product WHERE Product_ID='$id'")->fetch_assoc();
$suppliers = $conn->query("SELECT Supplier_ID, Supplier_Name FROM supplier");
$error = "";

if (isset($_POST['submit'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $category = $conn->real_escape_string($_POST['category']);
    $supplier = $conn->real_escape_string($_POST['supplier']);

    if (empty($name) || empty($category) || empty($supplier)) {
        $error = "All fields are required!";
    } else {
        $update = "UPDATE product SET Product_Name='$name', Category='$category', Supplier_ID='$supplier' WHERE Product_ID='$id'";
        if ($conn->query($update)) {
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
    <title>Edit Product</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
<h2 style="text-align:center;">Edit Product</h2>

<div style="width:400px; margin:auto; padding:20px; background:#f4e7d3; border-radius:10px;">
    <?php if ($error != "") { ?>
        <p style="color:red; text-align:center;"><?= $error ?></p>
    <?php } ?>

    <form method="POST">
        <label>Product Name:</label><br>
        <input type="text" name="name" value="<?= $product['Product_Name'] ?>" required><br><br>

        <label>Category:</label><br>
        <input type="text" name="category" value="<?= $product['Category'] ?>" required><br><br>

        <label>Supplier:</label><br>
        <select name="supplier" required>
            <option value="">-- Select Supplier --</option>
            <?php while ($row = $suppliers->fetch_assoc()) { ?>
                <option value="<?= $row['Supplier_ID'] ?>" <?= ($row['Supplier_ID']==$product['Supplier_ID'])?'selected':'' ?>>
                    <?= $row['Supplier_Name'] ?>
                </option>
            <?php } ?>
        </select>
        <br><br>

        <button type="submit" name="submit" style="padding:10px 16px; background:#5c4033; color:white; border:none; border-radius:5px;">Update</button>
    </form>
</div>
</body>
</html>
