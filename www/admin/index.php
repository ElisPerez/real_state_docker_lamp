<?php
// Importar la conexión a la database
require '../includes/config/database.php';
$db_connection = conectarDB();

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
    $result_image = mysqli_query($db_connection, $query_image);
    $image_array = mysqli_fetch_assoc($result_image);

    $image_path_to_delete = '../images/' . $image_array["image"];
    unlink($image_path_to_delete);

    // Eliminar la propiedad de la DB
    $query_delete_property = "DELETE FROM properties WHERE id = ${id};";
    $result_delete_property = mysqli_query($db_connection, $query_delete_property);

    if ($result_delete_property) {
      header('location: /admin');
    }
  }
}

// Incluye un template
require '../includes/functions.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
  <h1>Administrador de Bienes Raices</h1>
  <?php if (intval($result) === 1) : ?>
    <p class="alert success">Anuncio Creado Correctamente</p>
  <?php elseif (intval($result) === 2) : ?>
    <p class="alert success">Anuncio Actualizado Correctamente</p>
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
      <?php while ($property = mysqli_fetch_assoc($properties)) : ?>
        <tr>
          <td>
            <?php echo $property["id"]; ?>
          </td>
          <td><?php echo $property["title"]; ?></td>
          <td><img src="/images/<?php echo $property["image"]; ?>" alt="Casa en la playa" class="image-table" /></td>
          <td>$<?php echo $property["price"]; ?></td>
          <td>
            <a href="properties/update.php?id=<?php echo $property["id"]; ?>" class="boton-amarillo-block">Actualizar</a>

            <form method="POST" class="w-100">
              <input type="hidden" name="id" value="<?php echo $property["id"]; ?>" />
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