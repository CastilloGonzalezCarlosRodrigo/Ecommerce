<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Mi E-commerce</title>
  <link rel="stylesheet" href="css/index.css" />
</head>

<body>

  <header class="header">
    <div class="container">
      <img src="img/logo-random.png" alt="Logo E-commerce" class="logo" />
      <nav>
        <ul class="nav-links">
          <li><a href="index.php" class="active">Inicio</a></li>
          <li><a href="productos.php">Productos</a></li>
          <li><a href="carrito.php">Carrito</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main class="main-content">
    <section class="hero">
      <h1>Bienvenido a Tu Tienda Online</h1>
      <p>Encuentra productos únicos y de calidad para ti.</p>
      <a href="productos.php" class="btn-primary">Ver productos</a>
    </section>
  </main>

  <footer class="footer">
    <p>&copy; 2025 Mi E-commerce. Todos los derechos reservados.</p>
  </footer>

</body>

</html>