<?php
require '../includes/app.php';
// SESION DEL USER
isAuthenticated();
// Inport Property class
use App\Property;

// Implementar metodo para obtener todas las propiedades
$properties = Property::all();

// Muestra mensaje condicional
$result = $_GET["result"] ?? null;

// Eliminar una property
if ($_SERVER["REQUEST_METHOD"] === 'POST') {
  $id = $_POST["id"];
  $id = filter_var($id,  FILTER_VALIDATE_INT);

  if ($id) {
    $property = Property::find($id);
    $property->delete();
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
      <?php foreach ($properties as $property) : ?>
        <tr>
          <td>
            <?php echo $property->id; ?>
          </td>
          <td><?php echo $property->title; ?></td>
          <td><img src="/images/<?php echo $property->image; ?>" alt="Casa en la playa" class="image-table" /></td>
          <td>$<?php echo $property->price; ?></td>
          <td>
            <a href="properties/update.php?id=<?php echo $property->id; ?>" class="boton-amarillo-block">Actualizar</a>

            <form method="POST" class="w-100">
              <input type="hidden" name="id" value="<?php echo $property->id; ?>" />
              <input type="submit" class="boton-rojo-block" value="Eliminar" />
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</main>

<?php
// Cerrar la conexion a la DB
mysqli_close($db_connection);

incluirTemplate('footer');
?>