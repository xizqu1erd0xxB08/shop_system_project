<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h3>Edit Product</h3>
    <form action="../controllers/updateProductController.php" method="post">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" value="<?php echo $product_by_id['product_name']; ?>">
        <br><br>

        <label for="product_price">Product Price:</label>
        <input type="number" name="product_price" value="<?php echo $product_by_id['product_price']; ?>">
        <br><br>

        <label for="current_stock">Current Stock:</label>
        <input type="number" name="current_stock" value="<?php echo $product_by_id['current_stock']; ?>">
        <br><br>
        <input type="hidden" name="product_id" value="<?php echo $product_by_id['product_id']; ?>">

        <button type="submit">Edit Product</button>
    </form>
</body>
</html>