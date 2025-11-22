<?php
include "../config.php";
include '../header.php';

// Fetch products with supplier name
$sql = "
    SELECT 
        p.Product_ID,
        p.Product_Name,
        p.Category,
        s.Supplier_Name
    FROM product p
    LEFT JOIN supplier s ON p.Supplier_ID = s.Supplier_ID
";
$result = $conn->query($sql);
?>

<div style="padding:20px; background:#5c4033; min-height:100vh;">
    <h2 style="text-align:center; color:white;">Product List</h2>

    <!-- Add Product button (green, left side) -->
    <div style="text-align:left; margin-bottom:15px;">
        <a href="add.php" style="padding:10px 16px; background:green; color:white; border-radius:5px; text-decoration:none; font-weight:bold;">+ Add Product</a>
    </div>

    <!-- Product table -->
    <table border="1" cellpadding="10" cellspacing="0" style="width:100%; background:#d2b48c; border-collapse:collapse;">
        <tr style="background: #5C4033; color:white;">
            <th>ID</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Supplier</th>
            <th>Actions</th>
        </tr>

        <?php if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){ ?>
            <tr>
                <td><?= $row['Product_ID'] ?></td>
                <td><?= $row['Product_Name'] ?></td>
                <td><?= $row['Category'] ?></td>
                <td><?= $row['Supplier_Name'] ?></td>
                <td>
                    <!-- Edit/Delete buttons -->
                    <a href="edit.php?id=<?= $row['Product_ID'] ?>" style="padding:5px 8px; background:green; color:white; border-radius:5px; text-decoration:none;">Edit</a>
                    <a href="delete.php?id=<?= $row['Product_ID'] ?>" onclick="return confirm('Are you sure you want to delete this product?');" style="padding:5px 8px; background:red; color:white; border-radius:5px; text-decoration:none;">Delete</a>
                </td>
            </tr>
        <?php }
        } else { ?>
        <tr>
    <td colspan="5" style="text-align:center; background:white; color:black;">No products found.</td>
        </tr>
        <?php } ?>
    </table>
</div>
