<?php
require 'includes/app.php';
use App\Property;

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
  header('location: /');
}

$property = Property::find($id);

incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
  <h1><?php echo $property->title; ?></h1>


  <img loading="lazy" src="images/<?php echo $property->image; ?>" alt="<?php echo $property->title; ?>" />


  <div class="resumen-propiedad">
    <p class="precio">$ <?php echo $property->price; ?></p>

    <ul class="iconos-caracteristicas">
      <li>
        <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="Icono WC" />
        <p><?php echo $property->wc; ?></p>
      </li>
      <li>
        <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono Estacionamiento" />
        <p><?php echo $property->parking_lot; ?></p>
      </li>
      <li>
        <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono Habitaciones" />
        <p><?php echo $property->rooms; ?></p>
      </li>
    </ul>

    <p><?php echo $property->description ?></p>
  </div>
</main>

<?php
incluirTemplate('footer');
?>