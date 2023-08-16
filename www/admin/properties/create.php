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
  // echo "<pre>";
  // echo var_dump($_FILES);
  // echo "</pre>";

  // exit;

  $title       = mysqli_real_escape_string($db_connect, $_POST["title"]);
  $price       = mysqli_real_escape_string($db_connect, $_POST["price"]);
  $image       = mysqli_real_escape_string($db_connect, $_POST["image"]);
  $description = mysqli_real_escape_string($db_connect, $_POST["description"]);
  $rooms       = mysqli_real_escape_string($db_connect, $_POST["rooms"]);
  $wc          = mysqli_real_escape_string($db_connect, $_POST["wc"]);
  $parking_lot = mysqli_real_escape_string($db_connect, $_POST["parking_lot"]);
  $seller_id   = mysqli_real_escape_string($db_connect, $_POST["seller_id"]);
  // $seller_id   = $_POST["seller_id"] ?? '';
  // $seller_id   = !empty($_POST["seller_id"]) ? $_POST["seller_id"] : '';

  // Asignar $_Files a una variable
  $image = $_FILES["image"];
  echo "<pre>";
  echo var_dump($image);
  echo "</pre>";

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

  if (!$seller_id) {
    $errors[] = 'Vendedor es obligatorio';
  }

  if (!$image["name"]) {
    $errors[] = 'La imagen es obligatoria';
  }

  // Validar por tamaño (1Mb max)
  $medida = 1000 * 1000;
  if ($image["size"] > $medida || $image["error"]) {
    $errors[] = 'La imagen es muy pesada';
  }

  // Revisar que el array de errors esté vacío
  if (empty($errors)) {
    /** SUBIDA DE ARCHIVOS */

    // Crear carpeta
    $folderImages = '../../images/';

    // Verificar si ya existe la carpeta images
    if (!is_dir($folderImages)) {
      mkdir($folderImages);
    }

    // Obtener la extension
    $extension = pathinfo($image["name"])["extension"];

    // Generar un nombre único
    $imageName = md5( uniqid( rand(), true ) ) . "." . $extension;

    // Subir la imagen al servidor local
    move_uploaded_file($image["tmp_name"], $folderImages . $imageName);

    // Insertar en la base de datos
    $query = "INSERT INTO properties (title, price, image, description, rooms, wc, parking_lot, create_at, seller_id) VALUES ('$title', '$price', '$imageName', '$description', '$rooms', '$wc', '$parking_lot', '$create_at', '$seller_id');";

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

  <form action="/admin/properties/create.php" method="POST" class="formulario" enctype="multipart/form-data">
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