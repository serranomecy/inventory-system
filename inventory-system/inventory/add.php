<?php
include "../config.php";
$error = "";

// Fetch Products and Warehouses for dropdown
$products = $conn->query("SELECT Product_ID FROM product");
$warehouses = $conn->query("SELECT Warehouse_ID FROM warehouse");

if(isset($_POST['submit'])){
    $product = intval($_POST['product']);
    $warehouse = intval($_POST['warehouse']);
    $quantity = intval($_POST['quantity']);
    $reorder_level = intval($_POST['reorder_level']);
    $last_updated = date('Y-m-d H:i:s');

    if(empty($product) || empty($warehouse) || empty($quantity) || empty($reorder_level)){
        $error = "All fields are required!";
    } else {
        $sql = "INSERT INTO inventory (Product_ID, Warehouse_ID, Quantity, Reorder_Level, Last_Updated) 
                VALUES ($product, $warehouse, $quantity, $reorder_level, '$last_updated')";
        if($conn->query($sql)){
            header("Location:view.php");
            exit();
        } else {
            $error = "Error: ".$conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Inventory</title>
<style>
body{ background:#5c4033; color:white; font-family:Arial; }
.container{ background:#8b5e3c; padding:20px; width:400px; margin:50px auto; border-radius:10px; }
select, input[type=number]{ width:100%; padding:8px; margin-bottom:15px; border-radius:5px; border:none; }
button{ width:100%; padding:10px; background:green; border:none; border-radius:5px; font-weight:bold; cursor:pointer; color:white; }
button:hover{ background:#3b2a1f; }
.error{ color:#ff6666; text-align:center; margin-bottom:10px; }
</style>
</head>
<body>
<div class="container">
<h2>Add Inventory</h2>
<?php if($error!="") echo "<div class='error'>$error</div>"; ?>
<form method="POST">
<label>Product ID:</label>
<select name="product" required>
<option value="">-- Select Product --</option>
<?php while($p=$products->fetch_assoc()){ ?>
<option value="<?= $p['Product_ID'] ?>"><?= $p['Product_ID'] ?></option>
<?php } ?>
</select>

<label>Warehouse ID:</label>
<select name="warehouse" required>
<option value="">-- Select Warehouse --</option>
<?php while($w=$warehouses->fetch_assoc()){ ?>
<option value="<?= $w['Warehouse_ID'] ?>"><?= $w['Warehouse_ID'] ?></option>
<?php } ?>
</select>

<label>Quantity:</label>
<input type="number" name="quantity" min="0" required>

<label>Reorder Level:</label>
<input type="number" name="reorder_level" min="0" required>

<button type="submit" name="submit">Save</button>
</form>
</div>
</body>
</html>
