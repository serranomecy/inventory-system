<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Inventory Dashboard</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #d2b48c; /* light brown */
            margin: 0;
            padding: 0;
        }

        /* Navigation Bar */
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between; /* left at right naka-separate */
            background-color: #8b4513; /* dark brown */
            padding: 20px 30px;
            height: 100px;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            flex: 1;
            justify-content: center; /* center horizontally */
        }

        .navbar-left img {
            height: 100px;
            margin-right: 20px;
        }

        .navbar-left h1 {
            color: white;
            font-size: 36px;
            margin: 0;
            text-align: center;
        }

        .navbar-right a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            background-color: #f44336; /* red */
            border-radius: 5px;
            transition: background 0.3s;
        }

        .navbar-right a:hover {
            background-color: #c0392b;
        }

        .welcome {
            text-align: center;
            margin: 20px 0;
            font-size: 30px;
            color: #333;
        }

        /* Dashboard Buttons */
        .dashboard {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .card {
            background-color: #8b4513; /* green */
            color: white;
            width: 180px;
            height: 120px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            text-decoration: none;
            font-size: 18px;
            transition: transform 0.2s, background-color 0.3s;
        }

        .card i {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .card:hover {
            transform: scale(1.05);
            background-color: brown;
        }

        @media(max-width: 600px){
            .dashboard {
                flex-direction: column;
                align-items: center;
            }
        }

    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <div class="navbar-left">
            <img src="dopa1.jpg" alt="Logo">
            <h1>Inventory Management</h1>
        </div>
        <div class="navbar-right">
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <!-- Welcome message -->
    <p class="welcome">Welcome, <?php echo $_SESSION['username']; ?>!</p>

    <!-- Dashboard buttons -->
    <div class="dashboard">
        <a href="supplier/view.php" class="card"><i class="fas fa-truck"></i>Supplier</a>
        <a href="product/view.php" class="card"><i class="fas fa-box-open"></i>Product</a>
        <a href="warehouse/view.php" class="card"><i class="fas fa-warehouse"></i>Warehouse</a>
        <a href="inventory/view.php" class="card"><i class="fas fa-clipboard-list"></i>Inventory</a>
        <a href="customer/view.php" class="card"><i class="fas fa-user-friends"></i>Customer</a>
        <a href="orders/view.php" class="card"><i class="fas fa-shopping-cart"></i>Orders</a>
    </div>

</body>
</html>
