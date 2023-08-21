<?php
// Functions
require '../../includes/functions.php';

// SESION DEL USER
$auth = isAuthenticated();

if (!$auth) {
  header('location: /login.php');
}

// Validar Url por Id válido
$id = $_GET["id"];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
  header('Location: /admin');
}

// DataBase
require "../../includes/config/database.php";
$db_connect = conectarDB();

// Consulta para obtener la propiedad a actualizar
$query_property = "SELECT * FROM properties WHERE id = ${id};";
$response_property = mysqli_query($db_connect, $query_property);
$row_property = mysqli_fetch_assoc($response_property); // Al llamar solo una vez la funcion mysqli_fetch_assoc devuelve la primera fila de la tabla de la respuesta de la consulta


// Consultar para obtener los vendedores
$query_sellers = "SELECT * FROM sellers;";
$response_sellers = mysqli_query($db_connect, $query_sellers);

// Array con mensajes de errores
$errors = [];

$title       = $row_property["title"];
$price       = $row_property["price"];
$description = $row_property["description"];
$rooms       = $row_property["rooms"];
$wc          = $row_property["wc"];
$parking_lot = $row_property["parking_lot"];
$seller_id   = $row_property["seller_id"];
$create_at   = date('Y/m/d');
// Imagen para mostrar
$image_property = $row_property["image"];

// Ejecutar el formulario después de que el usuario envía el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $title       = mysqli_real_escape_string($db_connect, $_POST["title"]);
  $price       = mysqli_real_escape_string($db_connect, $_POST["price"]);
  $description = mysqli_real_escape_string($db_connect, $_POST["description"]);
  $rooms       = mysqli_real_escape_string($db_connect, $_POST["rooms"]);
  $wc          = mysqli_real_escape_string($db_connect, $_POST["wc"]);
  $parking_lot = mysqli_real_escape_string($db_connect, $_POST["parking_lot"]);
  $seller_id   = mysqli_real_escape_string($db_connect, $_POST["seller_id"]);
  // $seller_id   = $_POST["seller_id"] ?? '';
  // $seller_id   = !empty($_POST["seller_id"]) ? $_POST["seller_id"] : '';

  // Asignar $_Files a una variable
  $image = $_FILES["image"];

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

  // Validar por tamaño (1Mb max)
  $medida = 1000 * 1000;
  if ($image["size"] > $medida) {
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

    $imageName = '';

    if ($image["name"]) {
      // Eliminar imagen previa
      unlink($folderImages . $image_property);

      // Obtener la extension
      $extension = pathinfo($image["name"])["extension"];

      // Generar un nombre único
      $imageName = md5(uniqid(rand(), true)) . "." . $extension;

      // Subir la imagen al servidor local
      move_uploaded_file($image["tmp_name"], $folderImages . $imageName);
    } else {
      $imageName = $image_property;
    }

    // Actualizar en la base de datos
    $query_update_property = "UPDATE properties SET title = '${title}', price = ${price}, image = '${imageName}', description = '${description}', rooms = ${rooms}, wc = ${wc}, parking_lot = ${parking_lot}, seller_id = ${seller_id} WHERE id = ${id};";

    $result = mysqli_query($db_connect, $query_update_property);

    if ($result) {
      // Redireccionar al usuario
      header('Location: /admin?result=2');
    }
  }
}

incluirTemplate('header');
?>

<main class="contenedor seccion">
  <h1>Actualizar Propiedad</h1>

  <a href="/admin" class="boton boton-verde">Volver</a>

  <?php foreach ($errors as $error) : ?>

    <div class="alert error">
      <?php echo $error; ?>
    </div>

  <?php endforeach; ?>

  <form method="POST" class="formulario" enctype="multipart/form-data">
    <fieldset>
      <legend>Información General</legend>
      <label for="title">Título:</label>
      <input type="text" id="title" name="title" placeholder="Título Propiedad" value="<?php echo $title; ?>" />

      <label for="price">Precio:</label>
      <input type="number" id="price" name="price" placeholder="Precio Propiedad" value="<?php echo $price; ?>" />

      <label for="image">Imagen:</label>
      <input type="file" id="image" name="image" accept="image/jpeg image/png" />

      <img src="/images/<?php echo $image_property; ?>" alt="<?php echo $title; ?>" class="image-small" />

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
        <?php while ($row_seller = mysqli_fetch_assoc($response_sellers)) : ?>
          <option <?php echo $seller_id === $row_seller["id"] ? 'selected' : ''; ?> value="<?php echo $row_seller["id"] ?>">
            <?php echo $row_seller["first_name"] . " " . $row_seller["last_name"]; ?>
          </option>
        <?php endwhile; ?>
      </select>
    </fieldset>

    <input type="submit" value="Actualizar Propiedad" class="boton boton-verde" />
  </form>
</main>

<?php incluirTemplate('footer'); ?>