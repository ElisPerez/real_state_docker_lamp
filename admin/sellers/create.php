<?php
require '../../includes/app.php';

use App\Seller;

isAuthenticated();

$seller = new Seller;

// Array con mensajes de errores
$errors = Seller::getErrors();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Crear instancia
  $seller = new Seller($_POST['seller']);

  // Validar que no haya campos vacíos
  $errors = $seller->validate();

  // Si no hay errores
  if (empty($errors)) {
    $seller->save();
  }
}

incluirTemplate('header');
?>


<main class="contenedor seccion">
  <h1>Registrar Vendedor(a)</h1>

  <a href="/admin" class="boton boton-secondary">Volver</a>

  <?php foreach ($errors as $error) : ?>

    <div class="alert error">
      <?php echo $error; ?>
    </div>

  <?php endforeach; ?>

  <form action="/admin/sellers/create.php" method="POST" class="formulario">

    <?php include '../../includes/templates/form_sellers.php'; ?>

    <input type="submit" value="Registrar Vendedor(a)" class="boton boton-secondary" />
  </form>
</main>

<?php incluirTemplate('footer'); ?>