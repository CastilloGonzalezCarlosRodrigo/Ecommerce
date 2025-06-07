<?php
include 'includes/db.php';
include 'includes/header.php';

if (!isset($_GET['id'])) {
    echo "<p>Producto no especificado.</p>";
    include 'includes/footer.php';
    exit;
}

$id = intval($_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM productos WHERE id = $id");
$product = mysqli_fetch_assoc($query);

if (!$product) {
    echo "<p>Producto no encontrado.</p>";
    include 'includes/footer.php';
    exit;
}
?>

<main class="product-detail">
  <div class="product-container">
    <img src="img/<?php echo $product['imagen']; ?>" alt="<?php echo $product['nombre']; ?>" class="product-img">
    <div class="product-info">
      <h2><?php echo $product['nombre']; ?></h2>
      <p><?php echo $product['descripcion']; ?></p>
      <p><strong>Precio:</strong> $<?php echo $product['precio']; ?></p>
      <form method="post" action="cart.php">
        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
        <label>Cantidad:
          <input type="number" name="cantidad" value="1" min="1">
        </label>
        <br><br>
        <button type="submit" class="btn">Agregar al carrito</button>
      </form>
    </div>
  </div>
</main>

<?php include 'includes/footer.php'; ?>
