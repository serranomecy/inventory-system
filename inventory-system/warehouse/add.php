<?php
include "../config.php";
$error = "";

if(isset($_POST['submit'])){
    $name = $conn->real_escape_string($_POST['name']);
    $location = $conn->real_escape_string($_POST['location']);

    if(empty($name) || empty($location)){
        $error = "All fields are required!";
    } else {
        $sql = "INSERT INTO warehouse (Warehouse_Name, Location) VALUES ('$name', '$location')";
        if($conn->query($sql)){ header("Location:view.php"); exit(); }
        else { $error="Error: ".$conn->error; }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Add Warehouse</title>
<style>
body{ background:#5c4033; color:white; font-family:Arial; }
.container{ background:#8b5e3c; padding:20px; width:400px; margin:50px auto; border-radius:10px; }
input[type=text]{ width:100%; padding:8px; margin-bottom:15px; border-radius:5px; border:none; }
button{ width:100%; padding:10px; background:green; border:none; border-radius:5px; font-weight:bold; cursor:pointer; color:white; }
button:hover{ background:#3b2a1f; }
.error{ color:#ff6666; text-align:center; margin-bottom:10px; }
</style>
</head>
<body>
<div class="container">
<h2>Add Warehouse</h2>
<?php if($error!="") echo "<div class='error'>$error</div>"; ?>
<form method="POST">
<label>Warehouse Name:</label>
<input type="text" name="name" required>
<label>Location:</label>
<input type="text" name="location" required>
<button type="submit" name="submit">Save</button>
</form>
</div>
</body>
</html>
