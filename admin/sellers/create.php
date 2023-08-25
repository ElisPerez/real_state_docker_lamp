<?php
require '../../includes/app.php';

use App\Seller;

isAuthenticated();

$seller = new Seller;

// Array con mensajes de errores
$errors = Seller::getErrors();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
}

incluirTemplate('header');
?>


<main class="contenedor seccion">
  <h1>Registrar Vendedor(a)</h1>

  <a href="/admin" class="boton boton-purple">Volver</a>

  <?php foreach ($errors as $error) : ?>

    <div class="alert error">
      <?php echo $error; ?>
    </div>

  <?php endforeach; ?>

  <form action="/admin/sellers/create.php" method="POST" class="formulario">

    <?php include '../../includes/templates/form_sellers.php'; ?>

    <input type="submit" value="Registrar Vendedor(a)" class="boton boton-purple" />
  </form>
</main>

<?php incluirTemplate('footer'); ?>