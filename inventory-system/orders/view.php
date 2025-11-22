<?php
include "../config.php";
include '../header.php';

// Fetch orders
$sql = "SELECT * FROM orders ORDER BY Order_ID DESC";
$result = $conn->query($sql);
?>

<div style="padding:20px; background:#5c4033; min-height:100vh;">
    <h2 style="color:white; text-align:center; margin-bottom:20px;">Orders List</h2>

    <!-- Add Order button -->
    <div style="text-align:left; margin-bottom:15px;">
        <a href="add.php" style="padding:10px 16px; background:green; color:white; border-radius:5px; text-decoration:none; font-weight:bold;">+ Add Order</a>
    </div>

    <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse:collapse; background:white;">
        <tr style="background:#5C4033; color:white;">
            <th>Order ID</th>
            <th>Customer ID</th>
            <th>Product ID</th>
            <th>Quantity</th>
            <th>Order Date</th>
            <th>Actions</th>
        </tr>

        <?php if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['Order_ID'] ?></td>
                <td><?= $row['Customer_ID'] ?></td>
                <td><?= $row['Product_ID'] ?></td>
                <td><?= $row['Quantity'] ?></td>
                <td><?= $row['Order_Date'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['Order_ID'] ?>" style="padding:5px 8px; background:green; color:white; border-radius:5px; text-decoration:none;">Edit</a>
                    <a href="delete.php?id=<?= $row['Order_ID'] ?>" onclick="return confirm('Are you sure you want to delete this order?');" style="padding:5px 8px; background:red; color:white; border-radius:5px; text-decoration:none;">Delete</a>
                </td>
            </tr>
        <?php }
        } else { ?>
            <tr>
                <td colspan="6" style="text-align:center; color:black;">No orders found.</td>
            </tr>
        <?php } ?>
    </table>
</div>
