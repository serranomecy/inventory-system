<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}
?>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #7b5f3bff; 
    margin: 0;
    padding: 0;
}

/* Navigation Bar */
.navbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #8b4513;
    padding: 15px 30px;
    height: 120px; 
}

.navbar-left {
    display: flex;
    align-items: center;
    justify-content: center; 
    flex: 1; 
}

.navbar-left h1 {
    color: white;
    font-size: 50px; 
    margin: 0;
    text-align: center;
    font-family: 'Monotype Corsiva', sans-serif;

}

/* Back button */
.navbar-right a {
    color: white;
    text-decoration: none;
    padding: 10px 20px;
    background-color: red;
    border-radius: 5px;
    transition: background 0.3s;
    font-size: 18px;
}

.navbar-right a:hover {
    background-color: dark red;
}
</style>

<div class="navbar">
    <div class="navbar-left">
        <h1>Doperage Custom Garage</h1>
    </div>
    <div class="navbar-right">
        <a href="javascript:history.back()">Back</a>
    </div>
</div>
