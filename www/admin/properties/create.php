<?php
// DataBase
require "../../includes/config/database.php";
$db_connect = conectarDB();

// Consultar para obtener los vendedores
$query_sellers = "SELECT * FROM sellers;";

$sellers = mysqli_query($db_connect, $query_sellers);

// Array con mensajes de errores
$errors = [];

$title       = '';
$price       = '';
$image       = '';
$description = '';
$rooms       = '';
$wc          = '';
$parking_lot = '';
$seller_id   = '';
$create_at   = date('Y/m/d');

// Ejecutar el formulario después de que el usuario envía el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $title       = $_POST["title"];
  $price       = $_POST["price"];
  $image       = $_POST["image"];
  $description = $_POST["description"];
  $rooms       = $_POST["rooms"];
  $wc          = $_POST["wc"];
  $parking_lot = $_POST["parking_lot"];
  // $seller_id   = $_POST["seller_id"] ?? '';
  $seller_id   = !empty($_POST["seller_id"]) ? $_POST["seller_id"] : '';

  if (!$title) {
    // Agregar elementos a un array
    $errors[] = "Debes añadir un título";
  }

  if (!$price) {
    $errors[] = "El precio es obligatorio";
  }

  if (strlen($description) < 50) {
    $errors[] = "La descripción es obligatoria y debe tener al menos 50 carácteres";
  }

  if (!$rooms) {
    $errors[] = 'Habitaciones es obligatorio';
  }

  if (!$wc) {
    $errors[] = 'Baños es obligatorio';
  }

  if (!$parking_lot) {
    $errors[] = 'Estacionamiento es obligatorio';
  }

  if (isset($seller_id) && !$seller_id) {
    $errors[] = 'Vendedor es obligatorio';
  }

  // Revisar que el array de errors esté vacío
  if (empty($errors)) {
    // Insertar en la base de datos
    $query = "INSERT INTO properties (title, price, description, rooms, wc, parking_lot, create_at, seller_id) VALUES ('$title', '$price', '$description', '$rooms', '$wc', '$parking_lot', '$create_at', '$seller_id');";

    $result = mysqli_query($db_connect, $query);

    if ($result) {
      // Redireccionar al usuario
      header('Location: /admin');
    }
  }
}

// Functions
require '../../includes/functions.php';

incluirTemplate('header');
?>

<main class="contenedor seccion">
  <h1>Create</h1>

  <a href="/admin" class="boton boton-verde">Volver</a>

  <?php foreach ($errors as $error) : ?>

    <div class="alerta error">
      <?php echo $error; ?>
    </div>

  <?php endforeach; ?>

  <form action="/admin/properties/create.php" method="POST" class="formulario">
    <fieldset>
      <legend>Información General</legend>
      <label for="title">Título:</label>
      <input type="text" id="title" name="title" placeholder="Título Propiedad" value="<?php echo $title; ?>" />

      <label for="price">Precio:</label>
      <input type="number" id="price" name="price" placeholder="Precio Propiedad" value="<?php echo $price; ?>" />

      <label for="image">Imagen:</label>
      <input type="file" id="image" name="image" accept="image/jpeg image/png" />
      <label for="description">Descripción:</label>
      <div class="p-relative">
        <textarea name="description" id="description"><?php echo $description; ?></textarea>
        <div class="char-counter">
          <span class="char-count" id="charCount">0</span> / 250 caracteres
        </div>
      </div>
    </fieldset>

    <fieldset>
      <legend>Información Propiedad</legend>

      <label for="rooms">Habitaciones:</label>
      <input type="number" id="rooms" name="rooms" placeholder="Ej: 3" min="1" max="9" value="<?php echo $rooms; ?>" />

      <label for="wc">Baños:</label>
      <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc; ?>" />

      <label for="parking_lot">Estacionamiento:</label>
      <input type="number" id="parking_lot" name="parking_lot" placeholder="Ej: 3" min="1" max="9" value="<?php echo $parking_lot; ?>" />
    </fieldset>

    <fieldset>
      <legend>Vendedor</legend>

      <select name="seller_id">
        <option value="">-- Seleccione --</option>
        <?php while ($row = mysqli_fetch_assoc($sellers)) : ?>
          <option <?php echo $seller_id === $row["id"] ? 'selected' : ''; ?> value="<?php echo $row["id"] ?>">
            <?php echo $row["first_name"] . " " . $row["last_name"]; ?>
          </option>
        <?php endwhile; ?>
      </select>
    </fieldset>

    <input type="submit" value="Crear Propiedad" class="boton boton-verde" />
  </form>
</main>

<?php incluirTemplate('footer'); ?>