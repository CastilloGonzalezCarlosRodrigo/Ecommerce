<?php
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Manejo para eliminar un producto
if (isset($_POST['eliminar_id'])) {
    $idEliminar = $_POST['eliminar_id'];
    foreach ($_SESSION['carrito'] as $key => $item) {
        // Validar que $item sea array antes de acceder a 'id'
        if (is_array($item) && isset($item['id']) && $item['id'] == $idEliminar) {
            unset($_SESSION['carrito'][$key]);
            $_SESSION['carrito'] = array_values($_SESSION['carrito']); // reindexar
            break;
        }
    }
    header("Location: carrito.php");
    exit;
}

// Manejo para actualizar cantidades
if (isset($_POST['actualizar'])) {
    foreach ($_SESSION['carrito'] as &$item) {
        if (is_array($item) && isset($item['id'], $_POST['cantidad'][$item['id']])) {
            $cantidad = intval($_POST['cantidad'][$item['id']]);
            $item['cantidad'] = max(1, $cantidad);
        }
    }
    header("Location: carrito.php");
    exit;
}

// Manejo para vaciar carrito
if (isset($_POST['vaciar'])) {
    $_SESSION['carrito'] = [];
    header("Location: carrito.php");
    exit;
}

// Calcular total seguro validando estructura de cada item
$total = 0;
foreach ($_SESSION['carrito'] as $item) {
    if (is_array($item) && isset($item['precio'], $item['cantidad'])) {
        $total += $item['precio'] * $item['cantidad'];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Carrito - Mi E-commerce</title>
  <link rel="stylesheet" href="css/index.css" />
  <link rel="stylesheet" href="css/carrito.css" />
</head>
<body>

<header class="header">
  <div class="container">
    <img src="img/logo-random.png" alt="Logo E-commerce" class="logo" />
    <nav>
      <ul class="nav-links">
        <li><a href="index.php">Inicio</a></li>
        <li><a href="productos.php">Productos</a></li>
        <li><a href="carrito.php" class="active">Carrito</a></li>
      </ul>
    </nav>
  </div>
</header>

<main class="main-content">
  <section class="carrito-section container">
    <h2>Tu Carrito</h2>

    <?php if (empty($_SESSION['carrito'])): ?>
      <p class="msg empty">Tu carrito está vacío.</p>
      <p><a href="productos.php" class="btn-primary">Ir a productos</a></p>
    <?php else: ?>
      <form method="POST" class="carrito-form">
        <table class="carrito-table">
          <thead>
            <tr>
              <th>Producto</th>
              <th>Precio</th>
              <th>Cantidad</th>
              <th>Subtotal</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($_SESSION['carrito'] as $item): ?>
              <?php if (!is_array($item)) continue; ?>
              <tr>
                <td><?= htmlspecialchars($item['nombre']) ?></td>
                <td>$<?= number_format($item['precio'], 2) ?> MXN</td>
                <td>
                  <input type="number" name="cantidad[<?= $item['id'] ?>]" value="<?= $item['cantidad'] ?>" min="1" />
                </td>
                <td>$<?= number_format($item['precio'] * $item['cantidad'], 2) ?> MXN</td>
                <td>
                  <button type="submit" name="eliminar_id" value="<?= $item['id'] ?>" class="btn-eliminar">Eliminar</button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3" class="total-label">Total:</td>
              <td colspan="2" class="total-amount">$<?= number_format($total, 2) ?> MXN</td>
            </tr>
          </tfoot>
        </table>

        <div class="acciones-carrito">
          <button type="submit" name="actualizar" class="btn-actualizar">Actualizar cantidades</button>
          <button type="submit" name="vaciar" class="btn-vaciar">Vaciar carrito</button>
          <button type="button" onclick="alert('Compra simulada. ¡Gracias por tu preferencia!');" class="btn-comprar">Proceder a la compra</button>
        </div>
      </form>
    <?php endif; ?>
  </section>
</main>

<footer class="footer">
  <p>&copy; 2025 Mi E-commerce. Todos los derechos reservados.</p>
</footer>

</body>
</html>
