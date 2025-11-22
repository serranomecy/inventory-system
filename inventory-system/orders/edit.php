<?php
include "../config.php";
$error="";
if(!isset($_GET['id'])){ header("Location:view.php"); exit(); }
$id = intval($_GET['id']);

$order = $conn->query("SELECT * FROM orders WHERE Order_ID=$id");
if($order->num_rows==0){ header("Location:view.php"); exit(); }
$row = $order->fetch_assoc();

$customers = $conn->query("SELECT Customer_ID FROM customer");
$products = $conn->query("SELECT Product_ID FROM product");

if(isset($_POST['submit'])){
    $customer = intval($_POST['customer']);
    $product = intval($_POST['product']);
    $quantity = intval($_POST['quantity']);

    if(empty($customer) || empty($product) || empty($quantity)){
        $error = "All fields are required!";
    } else {
        $sql = "UPDATE orders SET Customer_ID=$customer, Product_ID=$product, Quantity=$quantity WHERE Order_ID=$id";
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
<title>Edit Order</title>
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
<h2>Edit Order</h2>
<?php if($error!="") echo "<div class='error'>$error</div>"; ?>
<form method="POST">
<label>Customer ID:</label>
<select name="customer" required>
<option value="">-- Select Customer --</option>
<?php while($c=$customers->fetch_assoc()){ ?>
<option value="<?= $c['Customer_ID']?>" <?= ($c['Customer_ID']==$row['Customer_ID'])?'selected':'' ?>><?= $c['Customer_ID']?></option>
<?php } ?>
</select>

<label>Product ID:</label>
<select name="product" required>
<option value="">-- Select Product --</option>
<?php while($p=$products->fetch_assoc()){ ?>
<option value="<?= $p['Product_ID']?>" <?= ($p['Product_ID']==$row['Product_ID'])?'selected':'' ?>><?= $p['Product_ID']?></option>
<?php } ?>
</select>

<label>Quantity:</label>
<input type="number" name="quantity" value="<?= $row['Quantity']?>" min="1" required>

<button type="submit" name="submit">Update</button>
</form>
</div>
</body>
</html>
