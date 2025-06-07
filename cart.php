<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

// Inicializar carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Agregar producto al carrito
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['product_id']) && isset($_POST['cantidad'])) {
        $product_id = intval($_POST['product_id']);
        $cantidad = intval($_POST['cantidad']);

        // Si ya existe el producto, sumar cantidades
        if (isset($_SESSION['carrito'][$product_id])) {
            $_SESSION['carrito'][$product_id] += $cantidad;
        } else {
            $_SESSION['carrito'][$product_id] = $cantidad;
        }

        // Redirigir para evitar reenvío del formulario
        header("Location: cart.php?agregado=1");
        exit();
    }
}

// Eliminar producto del carrito
if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);
    unset($_SESSION['carrito'][$id]);
    echo "<p class='msg'>Producto eliminado del carrito.</p>";
}
?>

<main class="cart">
  <h2>Carrito de compras</h2>

  <?php if (isset($_GET['agregado'])): ?>
    <p class="msg">✅ Producto agregado al carrito.</p>
  <?php endif; ?>

  <?php if (!empty($_SESSION['carrito'])): ?>
    <table>
      <thead>
        <tr>
          <th>Producto</th>
          <th>Cantidad</th>
          <th>Precio</th>
          <th>Subtotal</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $total = 0;
        foreach ($_SESSION['carrito'] as $id => $cantidad):
            $query = mysqli_query($conn, "SELECT * FROM productos WHERE id = $id");
            $producto = mysqli_fetch_assoc($query);

            if (!$producto) {
                continue; // Ignora si no se encuentra el producto
            }

            $subtotal = $producto['precio'] * $cantidad;
            $total += $subtotal;
        ?>
          <tr>
            <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
            <td><?php echo $cantidad; ?></td>
            <td>$<?php echo number_format($producto['precio'], 2); ?></td>
            <td>$<?php echo number_format($subtotal, 2); ?></td>
            <td><a href="cart.php?eliminar=<?php echo $id; ?>" class="btn btn-red">Eliminar</a></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <div class="total">
      <h3>Total: $<?php echo number_format($total, 2); ?></h3>
      <a href="checkout.php" class="btn">Finalizar compra</a>
    </div>
  <?php else: ?>
    <p>Tu carrito está vacío.</p>
  <?php endif; ?>
</main>

<?php include 'includes/footer.php'; ?>
