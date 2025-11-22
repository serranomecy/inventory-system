<?php
session_start();
include "config.php";


if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$error = "";
$welcome = "Welcome to Doperage Custom Garage!";

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];

            header("Location: index.php"); 
            exit();
        } else {
            $error = "Incorrect password!";
        }
    } else {
        $error = "User not found!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #66492eff; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            display: flex;
            align-items: center;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px #0008;
        }
        .logo {
            margin-right: 20px;
        }
        .logo img {
            height: 180px;
            width: 180px;
            border-radius: 10px;
        }
        .box {
            width: 300px;
            text-align: center;
        }
        .box input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #aaa;
        }
        .box button {
            width: 95%;
            padding: 10px;
            background: green;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .box button:hover {
            background: #60472aff;
        }
        a {
            color: #6b4f2a;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="logo">
        <img src="dopa.jpg" alt="Logo">
    </div>

    <div class="box">
        <h2>Login</h2>

        <!-- Welcome Message -->
        <p style="color:dark brown;"><?php echo $welcome; ?></p>

        <!-- Error Message -->
        <?php if (!empty($error)) { echo "<p style='color:red;'>$error</p>"; } ?>

        <form method="POST">
            <input type="text" name="username" placeholder="Enter username" required>
            <input type="password" name="password" placeholder="Enter password" required>
            <button type="submit" name="login">Login</button>
        </form>

        <p>New user? <a href="register.php">Create account</a></p>
    </div>
</div>

</body>
</html>
