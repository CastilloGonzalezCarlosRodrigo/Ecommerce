<!DOCTYPE html>
<html lang="es">
<?php
$page = basename($_SERVER['PHP_SELF']);
?>
<head>
  <meta charset="UTF-8">
  <title>Mi E-commerce</title>
  <link rel="stylesheet" href="css/global.css">
  <?php if ($page == 'cart.php'): ?>
    <link rel="stylesheet" href="css/cart.css">
  <?php elseif ($page == 'index.php'): ?>
    <link rel="stylesheet" href="css/index.css">
  <?php elseif ($page == 'product.php'): ?>
    <link rel="stylesheet" href="css/product.css">
  <?php endif; ?>
</head>
<body>
  <header>
    <nav>
      <h2>MiTienda</h2>
      <ul>
        <li><a href="index.php">Inicio</a></li>
        <li><a href="cart.php">Carrito</a></li>
        <li><a href="login.php">Acceder</a></li>
      </ul>
    </nav>
  </header>
