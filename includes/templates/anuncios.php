<?php
use App\Property;


if ($_SERVER["SCRIPT_NAME"] === '/anuncios.php') {
  // $properties = Property::all();
  $properties = Property::get(10);

} else {
  $properties = Property::get(3);
}
?>

<div class="contenedor-anuncios">
  <?php foreach ($properties as $property) { ?>
    <div class="anuncio">

      <img loading="lazy" src="/images/<?php echo $property->image; ?>" alt="<?php echo $property->title; ?>" />

      <div class="contenido-anuncio">
        <h3><?php echo $property->title; ?></h3>
        <p><?php echo $property->description; ?></p>
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

        <a href="anuncio.php?id=<?php echo $property->id; ?>" class="boton-secondary-block">
          Ver propiedad
        </a>
      </div>

    </div>
  <?php } ?>
</div>