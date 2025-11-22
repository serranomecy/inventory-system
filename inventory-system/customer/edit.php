<?php
include "../config.php";

$id = (int)$_GET['id'];
$result = $conn->query("SELECT * FROM inventory WHERE id=$id");
if($result->num_rows == 0){
    die("Item not found");
}
$item = $result->fetch_assoc();

if(isset($_POST['submit'])){
    $product_name = $conn->real_escape_string($_POST['product_name']);
    $category = $conn->real_escape_string($_POST['category']);
    $quantity = (int)$_POST['quantity'];
    $price = (float)$_POST['price'];

    $sql = "UPDATE inventory SET product_name='$product_name', category='$category', quantity=$quantity, price=$price WHERE id=$id";

    if($conn->query($sql)){
        header("Location: view.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Inventory</title>
</head>
<body>
<h2>Edit Inventory Item</h2>
<form method="post">
    <label>Product Name:</label><br>
    <input type="text" name="product_name" value="<?= htmlspecialchars($item['product_name']); ?>" required><br><br>

    <label>Category:</label><br>
    <input type="text" name="category" value="<?= htmlspecialchars($item['category']); ?>" required><br><br>

    <label>Quantity:</label><br>
    <input type="number" name="quantity" value="<?= $item['quantity']; ?>" required><br><br>

    <label>Price:</label><br>
    <input type="number" step="0.01" name="price" value="<?= $item['price']; ?>" required><br><br>

    <input type="submit" name="submit" value="Update Item">
</form>
<br>
<a href="view.php">Back to Inventory List</a>
</body>
</html>
