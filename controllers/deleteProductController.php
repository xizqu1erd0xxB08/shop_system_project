<?php 
session_start();
require_once '../config.php';
require_once '../models/Database.php';
require_once '../models/Product.php';

// Headers anti-caché - Fuerza al navegador a siempre pedir la página fresca
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

// Validar sesión del usuario
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
    header("Location: ../views/loginView.php");
    exit();
}

// Crear variable user_id que obtenemos de la sesión
$user_id = $_SESSION['user_id'];

// Validar POST del formulario con el product_id que necesitaremos para eliminar la tarea
if (!isset($_POST['product_id'])) {
    die("ID del producto NO encontrada");
}

// Crear la variable product_id
$product_id = $_POST['product_id'];

// Crear objeto database para obtener la conexión
$database = new Database($host_name, $host_admin, $host_admin_password, $database_name);

// Obtener conexión
$connection = $database->getConnection();

// Verificar conexión
if (!$connection) {
    die("Conexión fallida a la base de datos: " . mysqli_connect_error());
}

$product = new Product($connection); // Crear objeto Product

$delete_product = $product->deleteProduct($product_id, $user_id); // Llamar al método deleteProduct

// Verificar que se haya ejecutado correctamente
if (!$delete_product['success']) {
    $database->closeConnection();
    die($delete_product['errorMessage']);
}

// Todo OK
$database->closeConnection();
header("Location: viewProductsController.php");
exit();
?>