<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

$mensaje = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email'");
    if (mysqli_num_rows($check) > 0) {
        $mensaje = "Este correo ya está registrado.";
    } else {
        $insert = mysqli_query($conn, "INSERT INTO users (nombre, email, password) VALUES ('$nombre', '$email', '$password')");
        if ($insert) {
            $_SESSION['user'] = $nombre;
            header("Location: index.php");
            exit;
        } else {
            $mensaje = "Error al registrar. Intenta más tarde.";
        }
    }
}
?>

<main class="auth-container">
  <h2>Crear cuenta</h2>
  <?php if ($mensaje): ?><p class="msg"><?php echo $mensaje; ?></p><?php endif; ?>
  <form method="POST">
    <input type="text" name="nombre" placeholder="Nombre completo" required>
    <input type="email" name="email" placeholder="Correo electrónico" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button type="submit" class="btn">Registrarse</button>
  </form>
  <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
</main>

<?php include 'includes/footer.php'; ?>
