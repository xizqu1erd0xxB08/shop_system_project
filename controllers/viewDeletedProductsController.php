<?php 
session_start();
require_once '../config.php';
require_once '../models/Database.php';
require_once '../models/Product.php';

// Headers anti-caché - Fuerza al navegador a siempre pedir la página fresca
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

// Validar sesión activa del usuario
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
    header("Location: ../views/loginView.php");
    exit();
}

$user_id = $_SESSION['user_id']; // ID del usuario

$database = new Database($host_name, $host_admin, $host_admin_password, $database_name); // Objeto $database que se usa para obtener el método de conexión

$connection = $database->getConnection(); // Obtener la conexión a la base de datos

// Validar que la conexión a la base de datos haya sido exitosa
if (!$connection) {
    die("Conexión fallida a la base de datos: " . mysqli_connect_error());
}

$product = new Product($connection); // Objeto $product que contiene el método que mostrará los productos eliminados

$get_deleted_products = $product->getDeletedProducts($user_id); // Obtener los productos eliminados

/* Validar que el método se haya ejecutado correctamente o que el array del productos 
eliminados no esté vacío, en ambos casos, se mostrará el error que corresponda */

if (!$get_deleted_products['success']) {
    $database->closeConnection();
    die($get_deleted_products['errorMessage']);
}

// Sin errores, obtener el array de productos eliminados
$database->closeConnection();
$array_deleted_products = $get_deleted_products['deleted_products'];

// Incluir la vista
require_once '../views/viewDeletedProductsView.php';
?>