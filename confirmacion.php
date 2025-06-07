<?php
session_start();
include 'includes/header.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $direccion = htmlspecialchars($_POST['direccion']);
    $telefono = htmlspecialchars($_POST['telefono']);

    // Aquí se podría guardar el pedido en la base de datos

    // Limpiar carrito
    unset($_SESSION['carrito']);
}
?>

<main class="confirmation-container">
  <h2>¡Gracias por tu compra!</h2>
  <p>Tu pedido ha sido recibido y será enviado a:</p>
  <p><strong><?= $nombre ?></strong></p>
  <p><?= $direccion ?></p>
  <p>Te contactaremos al <strong><?= $telefono ?></strong> si es necesario.</p>
  <a href="index.php" class="btn">Volver al inicio</a>
</main>

<?php include 'includes/footer.php'; ?>
