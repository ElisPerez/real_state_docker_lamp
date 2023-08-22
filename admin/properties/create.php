<?php
// Functions
require '../../includes/app.php';

use App\Property;

// SESION DEL USER
isAuthenticated();

// DataBase
$db_connect = connectDB();

// Consultar para obtener los vendedores
$query_sellers = "SELECT * FROM sellers;";
$response_sellers = mysqli_query($db_connect, $query_sellers);

// Array con mensajes de errores
$errors = Property::getErrors(); // Accede a un metodo static de la clase Property que al ser static no hay necesidad de instanciar la clase.

$title       = '';
$price       = '';
$image       = '';
$description = '';
$rooms       = '';
$wc          = '';
$parking_lot = '';
$create_at   = date('Y/m/d');
$seller_id   = '';

// Ejecutar el formulario después de que el usuario envía el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $property = new Property($_POST);

  $errors = $property->validate();

  // Revisar que el array de errors esté vacío
  if (empty($errors)) {
    // Save to DB
    $property->create();

    // Asignar $_Files a una variable
    $image = $_FILES["image"];
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
    $imageName = md5(uniqid(rand(), true)) . "." . $extension;

    // Subir la imagen al servidor local
    move_uploaded_file($image["tmp_name"], $folderImages . $imageName);



    $result = mysqli_query($db_connect, $query);

    if ($result) {
      // Redireccionar al usuario
      header('Location: /admin?result=1');
    }
  }
}

incluirTemplate('header');
?>

<main class="contenedor seccion">
  <h1>Crear</h1>

  <a href="/admin" class="boton boton-verde">Volver</a>

  <?php foreach ($errors as $error) : ?>

    <div class="alert error">
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
          <span class="char-count" id="charCount">0</span> / 1200 caracteres
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
        <?php while ($row_seller = mysqli_fetch_assoc($response_sellers)) : ?>
          <option <?php echo $seller_id === $row_seller["id"] ? 'selected' : ''; ?> value="<?php echo $row_seller["id"] ?>">
            <?php echo $row_seller["first_name"] . " " . $row_seller["last_name"]; ?>
          </option>
        <?php endwhile; ?>
      </select>
    </fieldset>

    <input type="submit" value="Crear Propiedad" class="boton boton-verde" />
  </form>
</main>

<?php incluirTemplate('footer'); ?>