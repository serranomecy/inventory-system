<?php
include "config.php";

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        $success = "User Registered Successfully!";
    } else {
        $error = "Error creating user!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #f2f2f2;
        }

        .box {
            width: 350px;
            margin: 80px auto;
            padding: 25px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px #0004;
            text-align: center;
        }

        input {
            width: 90%;
            padding: 10px;
            margin: 8px;
            border-radius: 5px;
            border: 1px solid #aaa;
        }

        button {
            width: 95%;
            padding: 10px;
            background: green;
            color: white;
            border: none;
            border-radius: 5px;
        }

        button:hover { background: darkgreen; }
    </style>
</head>
<body>

<div class="box">
    <h2>Create New User</h2>

    <?php 
        if (!empty($success)) echo "<p style='color:green;'>$success</p>";
        if (!empty($error)) echo "<p style='color:red;'>$error</p>";
    ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Enter username" required>
        <input type="password" name="password" placeholder="Enter password" required>
        <button type="submit" name="register">Register</button>
    </form>

    <p><a href="login.php">Back to Login</a></p>
</div>

</body>
</html>
