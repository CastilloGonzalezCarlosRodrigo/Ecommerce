<?php
session_start();

// Configuración conexión
$host = 'localhost';
$db = 'ecommerce_db';
$user = 'root';
$pass = '';

// Conexión PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Paginación
$productos_por_pagina = 3;
$pagina_actual = isset($_GET['pagina']) ? max(1, intval($_GET['pagina'])) : 1;
$offset = ($pagina_actual - 1) * $productos_por_pagina;

// Obtener total productos
$totalProductosStmt = $pdo->query("SELECT COUNT(*) FROM productos");
$totalProductos = $totalProductosStmt->fetchColumn();
$totalPaginas = ceil($totalProductos / $productos_por_pagina);

// Obtener productos para esta página
$stmt = $pdo->prepare("SELECT * FROM productos LIMIT :limit OFFSET :offset");
$stmt->bindValue(':limit', $productos_por_pagina, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Productos - Mi E-commerce</title>
  <link rel="stylesheet" href="css/index.css" />
  <link rel="stylesheet" href="css/productos.css" />
</head>
<body>

<header class="header">
  <div class="container">
    <img src="img/logo-random.png" alt="Logo E-commerce" class="logo" />
    <nav>
      <ul class="nav-links">
        <li><a href="index.php">Inicio</a></li>
        <li><a href="productos.php" class="active">Productos</a></li>
        <li><a href="carrito.php">Carrito</a></li>
      </ul>
    </nav>
  </div>
</header>

<main class="main-content">
  <section class="productos-section container">
    <h2>Productos</h2>

    <div class="productos-grid">
      <?php if (!$productos): ?>
        <p>No hay productos disponibles.</p>
      <?php else: ?>
        <?php foreach ($productos as $producto): ?>
          <div class="producto-card">
            <img src="img/<?= htmlspecialchars($producto['imagen']) ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>" />
            <h3><?= htmlspecialchars($producto['nombre']) ?></h3>
            <p><?= htmlspecialchars($producto['descripcion']) ?></p>
            <p class="precio">$<?= number_format($producto['precio'], 2) ?> MXN</p>
            <form method="POST" action="cart.php">
              <input type="hidden" name="product_id" value="<?= $producto['id'] ?>" />
              <input type="hidden" name="cantidad" value="1">
              <button type="submit" class="btn-agregar">Agregar al carrito</button>
            </form>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <div class="paginacion">
      <?php if ($pagina_actual > 1): ?>
        <a href="?pagina=<?= $pagina_actual - 1 ?>" class="btn-pagina">&laquo; Anterior</a>
      <?php endif; ?>

      <span>Página <?= $pagina_actual ?> de <?= $totalPaginas ?></span>

      <?php if ($pagina_actual < $totalPaginas): ?>
        <a href="?pagina=<?= $pagina_actual + 1 ?>" class="btn-pagina">Siguiente &raquo;</a>
      <?php endif; ?>
    </div>
  </section>
</main>

<footer class="footer">
  <p>&copy; 2025 Mi E-commerce. Todos los derechos reservados.</p>
</footer>

</body>
</html>
