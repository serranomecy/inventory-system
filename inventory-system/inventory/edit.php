<?php
include "../config.php";
$error = "";
if(!isset($_GET['id'])){ header("Location:view.php"); exit(); }
$id = intval($_GET['id']);

$inventory = $conn->query("SELECT * FROM inventory WHERE Inventory_ID=$id");
if($inventory->num_rows==0){ header("Location:view.php"); exit(); }
$row = $inventory->fetch_assoc();

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
        $sql = "UPDATE inventory 
                SET Product_ID=$product, Warehouse_ID=$warehouse, Quantity=$quantity, Reorder_Level=$reorder_level, Last_Updated='$last_updated' 
                WHERE Inventory_ID=$id";
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
<title>Edit Inventory</title>
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
<h2>Edit Inventory</h2>
<?php if($error!="") echo "<div class='error'>$error</div>"; ?>
<form method="POST">
<label>Product ID:</label>
<select name="product" required>
<option value="">-- Select Product --</option>
<?php while($p=$products->fetch_assoc()){ ?>
<option value="<?= $p['Product_ID']?>" <?= ($p['Product_ID']==$row['Product_ID'])?'selected':'' ?>><?= $p['Product_ID']?></option>
<?php } ?>
</select>

<label>Warehouse ID:</label>
<select name="warehouse" required>
<option value="">-- Select Warehouse --</option>
<?php while($w=$warehouses->fetch_assoc()){ ?>
<option value="<?= $w['Warehouse_ID']?>" <?= ($w['Warehouse_ID']==$row['Warehouse_ID'])?'selected':'' ?>><?= $w['Warehouse_ID']?></option>
<?php } ?>
</select>

<label>Quantity:</label>
<input type="number" name="quantity" value="<?= $row['Quantity']?>" min="0" required>

<label>Reorder Level:</label>
<input type="number" name="reorder_level" value="<?= $row['Reorder_Level']?>" min="0" required>

<button type="submit" name="submit">Update</button>
</form>
</div>
</body>
</html>
