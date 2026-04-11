<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Deleted Products</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h2>My Deleted Products</h2>
    <table class="table table-striped table-hover table-bordered">
        <tr>
            <th>Product Name:</th>
            <th>Product Price:</th>
            <th>Current Stock:</th>
            <th>Created At:</th>
            <th>Updated At:</th>
            <th>Reactivate Product</th>
        </tr>

        <?php foreach($array_deleted_products as $deleted_product): ?>
            <tr>
                <td><?php echo $deleted_product['product_name']; ?></td>
                <td><?php echo $deleted_product['product_price']; ?></td>
                <td><?php echo $deleted_product['current_stock']; ?></td>
                <td><?php echo $deleted_product['created_at']; ?></td>
                <td><?php echo $deleted_product['updated_at']; ?></td>
                <td>
                    <form action="../controllers/reactivateProductController.php" method="post" style="display: inline;"> <!-- style="display: inline;" → El formulario NO ocupa espacio extra (queda en la misma línea) -->
                        <input type="hidden" name="product_id" value="<?php echo $deleted_product['product_id']; ?>"> <!-- <input type="hidden"> → Envía el product_id pero NO se ve en pantalla -->
                        <button type="submit" class="btn-reactivate">Reactivate!</button> <!-- <button type="submit"> → Botón clickeable que envía el formulario por POST -->
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <script>
    // Confirmación antes de reactivar un producto
    document.querySelectorAll('.btn-reactivate').forEach(function(button) {
        button.addEventListener('click', function(e) {
            const confirmed = confirm('¿Quieres reactivar este producto?');
            if (!confirmed) {
                e.preventDefault();
            }
        });
    });
    </script>
</body>
</html>