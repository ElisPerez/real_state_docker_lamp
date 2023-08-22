<?php
require '../includes/functions.php';

// SESION DEL USER
isAuthenticated();

// Importar la conexión a la database
require '../includes/config/database.php';
$db_connection = connectDB();

// Escribir el query
$query = "SELECT * FROM properties;";

// Consultar la DB
$properties = mysqli_query($db_connection, $query);

// Muestra mensaje condicional
$result = $_GET["result"] ?? null;

// Eliminar una property
if ($_SERVER["REQUEST_METHOD"] === 'POST') {
  $id = $_POST["id"];
  $id = filter_var($id,  FILTER_VALIDATE_INT);

  if ($id) {
    // Obtener nombre de la imagen a eliminar
    $query_image = "SELECT image FROM properties WHERE id = ${id};";
    $result_set_image = mysqli_query($db_connection, $query_image);
    $row_image = mysqli_fetch_assoc($result_set_image); // Como estoy llamando una sola vez a mysqli_fetch_assoc solo devuelve la primera fila de la tabla.

    $image_path_to_delete = '../images/' . $row_image["image"];
    unlink($image_path_to_delete);

    // Eliminar la propiedad de la DB
    $query_delete_property = "DELETE FROM properties WHERE id = ${id};";
    $result_delete_property = mysqli_query($db_connection, $query_delete_property);

    if ($result_delete_property) {
      header('location: /admin?result=3');
    }
  }
}

// Incluye un template
incluirTemplate('header');
?>

<main class="contenedor seccion">
  <h1>Administrador de Bienes Raices</h1>
  <?php if (intval($result) === 1) : ?>
    <p class="alert success">Anuncio Creado Correctamente</p>
  <?php elseif (intval($result) === 2) : ?>
    <p class="alert success">Anuncio Actualizado Correctamente</p>
  <?php elseif (intval($result) === 3) : ?>
    <p class="alert success">Anuncio Eliminado Correctamente</p>
  <?php endif; ?>

  <a href="/admin/properties/create.php" class="boton boton-verde">Nueva Propiedad</a>

  <table class="properties">
    <thead>
      <tr>
        <th>ID</th>
        <th>Titulo</th>
        <th>Imagen</th>
        <th>Precio</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <!-- Mostrar los datos de la DB -->
      <?php while ($row_property = mysqli_fetch_assoc($properties)) : ?>
        <tr>
          <td>
            <?php echo $row_property["id"]; ?>
          </td>
          <td><?php echo $row_property["title"]; ?></td>
          <td><img src="/images/<?php echo $row_property["image"]; ?>" alt="Casa en la playa" class="image-table" /></td>
          <td>$<?php echo $row_property["price"]; ?></td>
          <td>
            <a href="properties/update.php?id=<?php echo $row_property["id"]; ?>" class="boton-amarillo-block">Actualizar</a>

            <form method="POST" class="w-100">
              <input type="hidden" name="id" value="<?php echo $row_property["id"]; ?>" />
              <input type="submit" class="boton-rojo-block" value="Eliminar" />
            </form>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</main>

<?php
// Cerrar la conexion a la DB
mysqli_close($db_connection);

incluirTemplate('footer');
?>