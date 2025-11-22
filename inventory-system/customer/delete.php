<?php
include "../config.php";

$id = (int)$_GET['id'];

$conn->query("DELETE FROM inventory WHERE id=$id");

header("Location: view.php");
exit;
?>
