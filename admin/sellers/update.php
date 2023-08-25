<?php
require '../../includes/app.php';

use App\Seller;

isAuthenticated();

// Validar ID
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
  header('location: /admin');
}

// Obtener vendedor desde DB
$seller = Seller::find($id);

// Array con mensajes de errores
$errors = Seller::getErrors();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Asignar los valores
  $args = $_POST['seller'];
  // Sincronizar objeto en memoria con los datos que escribio el usuario
  $seller->synchronize($args);
  // Validación
  $errors = $seller->validate();

  if (empty($errors)) {
    // Guardar en DB
    $seller->save();
  }
}

incluirTemplate('header');
?>


<main class="contenedor seccion">
  <h1>Actualizar Vendedor(a)</h1>

  <a href="/admin" class="boton boton-secondary">Volver</a>

  <?php foreach ($errors as $error) : ?>

    <div class="alert error">
      <?php echo $error; ?>
    </div>

  <?php endforeach; ?>

  <form method="POST" class="formulario">

    <?php include '../../includes/templates/form_sellers.php'; ?>

    <input type="submit" value="Guardar Cambios" class="boton boton-secondary" />
  </form>
</main>

<?php incluirTemplate('footer'); ?>