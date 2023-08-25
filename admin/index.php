<?php
require '../includes/app.php';
// SESION DEL USER
isAuthenticated();
// Inport Property class
use App\Property;
use App\Seller;

// Implementar metodo para obtener todas las propiedades
$properties = Property::all();
$sellers = Seller::all();

// Muestra mensaje condicional
$result = $_GET["result"] ?? null;

// Eliminar una property
if ($_SERVER["REQUEST_METHOD"] === 'POST') {
  $id = $_POST["id"];
  $id = filter_var($id,  FILTER_VALIDATE_INT);

  if ($id) {
    $type = $_POST['type'];
    if (validateTypeContent($type))

      // Compara lo que vamos a eliminar
      if ($type === 'seller') {
        $seller = Seller::find($id);
        $seller->delete();
      } else if ($type === 'property') {
        $property = Property::find($id);
        $property->delete();
      }
  }
}

// Incluye un template
incluirTemplate('header');
?>

<main class="contenedor seccion">
  <h1>Administrador de Bienes Raices</h1>
  <?php if (intval($result) === 1) : ?>
    <p class="alert success">Creado Correctamente</p>
  <?php elseif (intval($result) === 2) : ?>
    <p class="alert success">Actualizado Correctamente</p>
  <?php elseif (intval($result) === 3) : ?>
    <p class="alert success">Eliminado Correctamente</p>
  <?php endif; ?>

  <a href="/admin/properties/create.php" class="boton boton-primary">Nueva Propiedad</a>
  <a href="/admin/sellers/create.php" class="boton boton-secondary">Nuevo(a) Vendedor</a>

  <h2>Propiedades</h2>

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
            <a href="/admin/properties/update.php?id=<?php echo $property->id; ?>" class="boton-secondary-block">Actualizar</a>

            <form method="POST" class="w-100">
              <input type="hidden" name="id" value="<?php echo $property->id; ?>" />
              <input type="hidden" name="type" value="property" />
              <input type="submit" class="boton-error-block" value="Eliminar" />
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <h2>Vendedores</h2>

  <table class="properties">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Teléfono</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <!-- Mostrar los datos de la DB -->
      <?php foreach ($sellers as $seller) : ?>
        <tr>
          <td><?php echo $seller->id; ?></td>
          <td><?php echo $seller->first_name . " " . $seller->last_name; ?></td>
          <td><?php echo $seller->phone; ?></td>
          <td>
            <a href="/admin/sellers/update.php?id=<?php echo $seller->id; ?>" class="boton-secondary-block">Actualizar</a>

            <form method="POST" class="w-100">
              <input type="hidden" name="id" value="<?php echo $seller->id; ?>" />
              <input type="hidden" name="type" value="seller" />
              <input type="submit" class="boton-error-block" value="Eliminar" />
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</main>

<?php incluirTemplate('footer'); ?>