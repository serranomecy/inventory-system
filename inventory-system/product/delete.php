<?php
include "../config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM product WHERE Product_ID='$id'");
}

header("Location: view.php");
exit();
