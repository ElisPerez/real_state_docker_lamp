<?php
$db_connection = connectDB();

// Consultar la DB
$query_properties = "SELECT * FROM properties LIMIT ${limit};";

// Obtener resultados
$result_set_properties = mysqli_query($db_connection, $query_properties);
?>

<div class="contenedor-anuncios">
  <?php while ($row_property = mysqli_fetch_assoc($result_set_properties)) : ?>
    <div class="anuncio">

      <img loading="lazy" src="/images/<?php echo $row_property['image']; ?>" alt="<?php echo $row_property['title']; ?>" />


      <div class="contenido-anuncio">
        <h3><?php echo $row_property['title']; ?></h3>
        <p><?php echo $row_property['description']; ?></p>
        <p class="precio">$ <?php echo $row_property['price']; ?></p>

        <ul class="iconos-caracteristicas">
          <li>
            <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="Icono WC" />
            <p><?php echo $row_property['wc']; ?></p>
          </li>
          <li>
            <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono Estacionamiento" />
            <p><?php echo $row_property['parking_lot']; ?></p>
          </li>
          <li>
            <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono Habitaciones" />
            <p><?php echo $row_property['rooms']; ?></p>
          </li>
        </ul>

        <a href="anuncio.php?id=<?php echo $row_property['id']; ?>" class="boton-amarillo-block">
          Ver propiedad
        </a>
      </div>

    </div>
  <?php endwhile; ?>
</div>

<?php
// Cerrar conexion de la DB
mysqli_close($db_connection);
?>