<?php
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
  header('location: /');
}

require 'includes/functions.php';
incluirTemplate('header');

// Importar la DB
require 'includes/config/database.php'; // Se hizo asi porque el require es relativo a donde se esté incluyendo el anuncios.php, no a la hubicacion de anuncios.php
$db_connection = conectarDB();

// Consultar la DB
$query_property = "SELECT * FROM properties WHERE id = ${id};";


// Obtener resultados
$result_set_property = mysqli_query($db_connection, $query_property);
// Si no existe ese registro por ese id redireccionar a home
// if ($result_set_property->num_rows === 0) {
if (!$result_set_property->num_rows) {
  header('location: /');
}
$row_property = mysqli_fetch_assoc($result_set_property);

?>

<main class="contenedor seccion contenido-centrado">
  <h1><?php echo $row_property['title']; ?></h1>


  <img loading="lazy" src="images/<?php echo $row_property['image']; ?>" alt="<?php echo $row_property['title']; ?>" />


  <div class="resumen-propiedad">
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

    <p><?php echo $row_property['description'] ?></p>
  </div>
</main>

<?php
// Cerrar conexion de la DB
mysqli_close($db_connection);

incluirTemplate('footer');
?>