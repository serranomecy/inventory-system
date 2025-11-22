<?php
include "../config.php";
include '../header.php';

$sql = "SELECT * FROM inventory ORDER BY Inventory_ID DESC";
$result = $conn->query($sql);
?>

<div style="padding:20px; background:#5c4033; min-height:100vh;">
    <h2 style="color:white; text-align:center; margin-bottom:20px;">Inventory List</h2>

    <div style="text-align:left; margin-bottom:15px;">
        <a href="add.php" style="padding:10px 16px; background:green; color:white; border-radius:5px; text-decoration:none; font-weight:bold;">+ Add Inventory</a>
    </div>

    <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse:collapse; background:white;">
        <tr style="background: #5C4033; color:white;">
            <th>Inventory ID</th>
            <th>Product ID</th>
            <th>Warehouse ID</th>
            <th>Quantity</th>
            <th>Reorder Level</th>
            <th>Last Updated</th>
            <th>Actions</th>
        </tr>

        <?php if($result->num_rows>0){
            while($row=$result->fetch_assoc()){ ?>
            <tr>
                <td><?= $row['Inventory_ID']?></td>
                <td><?= $row['Product_ID']?></td>
                <td><?= $row['Warehouse_ID']?></td>
                <td><?= $row['Quantity']?></td>
                <td><?= $row['Reorder_Level']?></td>
                <td><?= $row['Last_Updated']?></td>
                <td>
                    <a href="edit.php?id=<?= $row['Inventory_ID']?>" style="padding:5px 8px; background:green; color:white; border-radius:5px; text-decoration:none;">Edit</a>
                    <a href="delete.php?id=<?= $row['Inventory_ID']?>" onclick="return confirm('Are you sure you want to delete this record?');" style="padding:5px 8px; background:red; color:white; border-radius:5px; text-decoration:none;">Delete</a>
                </td>
            </tr>
        <?php }
        } else { ?>
            <tr>
                <td colspan="7" style="text-align:center; color:black;">No inventory records found.</td>
            </tr>
        <?php } ?>
    </table>
</div>
