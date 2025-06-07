<?php
session_start();
include 'includes/header.php';

$carrito = $_SESSION['carrito'] ?? [];
$total = 0;

// Simulación de productos agregados al carrito (esto debe venir de la lógica de "agregar al carrito")
if (empty($carrito)) {
    $carrito = [
        ['nombre' => 'Producto A', 'precio' => 299.99, 'cantidad' => 1],
        ['nombre' => 'Producto B', 'precio' => 499.00, 'cantidad' => 2]
    ];
    $_SESSION['carrito'] = $carrito;
}

foreach ($carrito as $producto) {
    $total += $producto['precio'] * $producto['cantidad'];
}
?>

<main class="checkout-container">
  <h2>Resumen del pedido</h2>

  <div class="checkout-summary">
    <ul>
      <?php foreach ($carrito as $producto): ?>
        <li>
          <?= htmlspecialchars($producto['nombre']) ?> - <?= $producto['cantidad'] ?> × $<?= number_format($producto['precio'], 2) ?>
        </li>
      <?php endforeach; ?>
    </ul>
    <p class="total">Total: $<?= number_format($total, 2) ?> MXN</p>
  </div>

  <form method="POST" action="confirmacion.php" class="checkout-form">
    <input type="text" name="nombre" placeholder="Nombre completo" required>
    <input type="text" name="direccion" placeholder="Dirección de entrega" required>
    <input type="tel" name="telefono" placeholder="Teléfono de contacto" required>
    <button type="submit" class="btn">Finalizar compra</button>
  </form>
</main>

<?php include 'includes/footer.php'; ?>
