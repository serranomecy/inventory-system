<?php
include "../config.php";
if(!isset($_GET['id'])) { header("Location:view.php"); exit(); }
$id = intval($_GET['id']);
$conn->query("DELETE FROM supplier WHERE Supplier_ID=$id");
header("Location:view.php");
exit();
?>
