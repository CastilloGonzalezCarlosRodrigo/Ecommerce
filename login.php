<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

$mensaje = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    $user = mysqli_fetch_assoc($query);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['nombre'];
        header("Location: index.php");
        exit;
    } else {
        $mensaje = "Correo o contraseña incorrectos.";
    }
}
?>

<main class="auth-container">
  <h2>Iniciar sesión</h2>
  <?php if ($mensaje): ?><p class="msg error"><?php echo $mensaje; ?></p><?php endif; ?>
  <form method="POST">
    <input type="email" name="email" placeholder="Correo electrónico" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button type="submit" class="btn">Ingresar</button>
  </form>
  <p>¿No tienes cuenta? <a href="register.php">Regístrate</a></p>
</main>

<?php include 'includes/footer.php'; ?>
