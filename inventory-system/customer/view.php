<?php
include "../config.php";
include '../header.php';

$result = $conn->query("SELECT * FROM customer");
?>

<div style="padding:20px; background:#5c4033; min-height:100vh;">
    <h2 style="text-align:center; color:white;">Customer List</h2>

    <div style="text-align:left; margin-bottom:15px;">
        <a href="add.php" style="padding:10px 16px; background:green; color:white; border-radius:5px; text-decoration:none; font-weight:bold;">+ Add Customer</a>
    </div>

    <table border="1" cellpadding="10" cellspacing="0" style="width:100%; background:#d2b48c; border-collapse:collapse;">
        <tr style="background:#5C4033; color:white;">
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Actions</th>
        </tr>

        <?php if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){ ?>
            <tr>
                <td><?= $row['Customer_ID'] ?></td>
                <td><?= $row['Full_Name'] ?></td>
                <td><?= $row['Email'] ?></td>
                <td><?= $row['Contact'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['Customer_ID'] ?>" style="padding:5px 8px; background:green; color:white; border-radius:5px; text-decoration:none;">Edit</a>
                    <a href="delete.php?id=<?= $row['Customer_ID'] ?>" onclick="return confirm('Are you sure?');" style="padding:5px 8px; background:red; color:white; border-radius:5px; text-decoration:none;">Delete</a>
                </td>
            </tr>
        <?php }
        } else { ?>
            <tr>
                <td colspan="5" style="text-align:center; background:white; color:black;">No customers found.</td>
            </tr>
        <?php } ?>
    </table>
</div>
