<?php
include "../config.php";
$error="";
if(isset($_POST['submit'])){
    $name=$conn->real_escape_string($_POST['name']);
    $email=$conn->real_escape_string($_POST['email']);
    $contact=$conn->real_escape_string($_POST['contact']);

    if(empty($name) || empty($email) || empty($contact)){ $error="All fields are required!"; }
    else{
        $sql="INSERT INTO customer (Full_Name, Email, Contact) VALUES ('$name','$email','$contact')";
        if($conn->query($sql)){ header("Location:view.php"); exit(); }
        else{ $error="Error: ".$conn->error; }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Add Customer</title>
<style>
body{ background:#5c4033; color:white; font-family:Arial; }
.container{ background:#8b5e3c; padding:20px; width:400px; margin:50px auto; border-radius:10px; }
input[type=text], input[type=email]{ width:100%; padding:8px; margin-bottom:15px; border-radius:5px; border:none; }
button{ width:100%; padding:10px; background:green; border:none; border-radius:5px; font-weight:bold; cursor:pointer; color:white; }
button:hover{ background:#3b2a1f; }
.error{ color:#ff6666; text-align:center; margin-bottom:10px; }
</style>
</head>
<body>
<div class="container">
<h2>Add Customer</h2>
<?php if($error!="") echo "<div class='error'>$error</div>"; ?>
<form method="POST">
<label>Full Name:</label>
<input type="text" name="name" required>
<label>Email:</label>
<input type="email" name="email" required>
<label>Contact:</label>
<input type="text" name="contact" required>
<button type="submit" name="submit">Save</button>
</form>
</div>
</body>
</html>
