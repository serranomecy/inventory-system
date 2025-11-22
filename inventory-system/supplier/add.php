<?php
include "../config.php";

$error = "";

if(isset($_POST['submit'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $contact = $conn->real_escape_string($_POST['contact']);

    if(empty($name) || empty($contact)) {
        $error = "All fields are required!";
    } else {
        $sql = "INSERT INTO supplier (Supplier_Name, Contact) VALUES ('$name', '$contact')";
        if($conn->query($sql)) {
            header("Location: view.php");
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
<title>Add Supplier</title>
<style>
body { background:#5c4033; color:white; font-family:Arial; }
.container { background:#8b5e3c; padding:20px; width:400px; margin:50px auto; border-radius:10px; }
input[type=text] { width:100%; padding:8px; margin-bottom:15px; border-radius:5px; border:none; }
button { width:100%; padding:10px; background:green; border:none; border-radius:5px; font-weight:bold; cursor:pointer; color:white; }
button:hover { background:#3b2a1f; }
.error { color:#ff6666; text-align:center; margin-bottom:10px; }
</style>
</head>
<body>
<div class="container">
<h2>Add Supplier</h2>
<?php if($error != "") echo "<div class='error'>$error</div>"; ?>
<form method="POST">
<label>Supplier Name:</label>
<input type="text" name="name" required>
<label>Contact:</label>
<input type="text" name="contact" required>
<button type="submit" name="submit">Save</button>
</form>
</div>
</body>
</html>
