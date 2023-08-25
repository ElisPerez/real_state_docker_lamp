<?php
require 'includes/app.php';

// Database
$db_connection = connectDB();

// SESION DEL USER
isAuthenticated();

// Errores
$errors = [];

// Autenticar el usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = mysqli_real_escape_string($db_connection, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
  $password = mysqli_real_escape_string($db_connection, $_POST['password']);

  if (!$email) {
    $errors[] = 'El email es obligatorio o no es válido';
  }

  if (!$password) {
    $errors[] = 'El password es obligatorio';
  }

  if (empty($errors)) {
    // Revisar si el usuario existe
    $queryUserExist = "SELECT * FROM users WHERE email = '${email}'";
    $resultSetUserExist = mysqli_query($db_connection, $queryUserExist);

    // var_dump($resultSetUserExist); // si num_rows es 1 si existe, si es 0 no existe

    if ($resultSetUserExist->num_rows) {
      $user = mysqli_fetch_assoc($resultSetUserExist);

      // Verificar password
      $auth = password_verify($password, $user['password']); // true OR false

      if ($auth) {
        // El usuario está autenticado
        session_start();

        // Eliminar el campo de contraseña del array $user
        unset($user['password']);

        // Llenar el array de la _SESSION
        $_SESSION['user'] = $user;
        $_SESSION['login'] = true;

        // echo '<pre>';
        // echo var_dump($_SESSION);
        // echo '</pre>';
        // Acceder al email (ejemplo)
        // $email = $_SESSION['user']['email'];
        // Ahora puedes utilizar la variable $email como lo necesites
        // echo "El email del usuario es: " . $email;

        header('location: /admin');
      } else {
        $errors[] = "Contraseña no válida";
      }
    } else {
      $errors[] = "El usuario no existe";
    }
  }
}

// Incluye el header
incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
  <h1>Iniciar Sesión</h1>

  <?php foreach ($errors as $error) : ?>
    <div class="alert error">
      <?php echo $error; ?>
    </div>
  <?php endforeach; ?>

  <form method="post" class="formulario" novalidate>
    <fieldset>
      <legend>Email y Password</legend>

      <label for="email">E-mail</label>
      <input type="email" name="email" id="email" placeholder="Tu Email" required />

      <label for="password">Password</label>
      <input type="password" name="password" id="password" placeholder="Tu Password" required />

      <input type="submit" value="Iniciar Sesión" class="boton boton-primary" />
    </fieldset>
  </form>
</main>

<?php

incluirTemplate('footer');

?>