<?php
include "../config.php";
include '../header.php';

$result = $conn->query("SELECT * FROM supplier");
?>

<div style="padding:20px; background:#5c4033; min-height:100vh;">
    <h2 style="text-align:center; color:white;">Supplier List</h2>

    <div style="text-align:left; margin-bottom:15px;">
        <a href="add.php" style="padding:10px 16px; background:green; color:white; border-radius:5px; text-decoration:none; font-weight:bold;">+ Add Supplier</a>
    </div>

    <table border="1" cellpadding="10" cellspacing="0" style="width:100%; background:#d2b48c; border-collapse:collapse;">
        <tr style="background:#8b5e3c; color:white;">
            <th>ID</th>
            <th>Supplier Name</th>
            <th>Contact</th>
            <th>Actions</th>
        </tr>

        <?php if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){ ?>
            <tr>
                <td><?= $row['Supplier_ID'] ?></td>
                <td><?= $row['Supplier_Name'] ?></td>
                <td><?= $row['Contact'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['Supplier_ID'] ?>" style="padding:5px 8px; background:green; color:white; border-radius:5px; text-decoration:none;">Edit</a>
                    <a href="delete.php?id=<?= $row['Supplier_ID'] ?>" onclick="return confirm('Are you sure?');" style="padding:5px 8px; background:red; color:white; border-radius:5px; text-decoration:none;">Delete</a>
                </td>
            </tr>
        <?php }
        } else { ?>
            <tr>
                <td colspan="4" style="text-align:center; background:white; color:black;">No suppliers found.</td>
            </tr>
        <?php } ?>
    </table>
</div>
