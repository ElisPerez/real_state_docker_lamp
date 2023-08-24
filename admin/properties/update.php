<?php
// Functions

use App\Property;
use Intervention\Image\ImageManagerStatic as InterImage;

require '../../includes/app.php';

// SESION DEL USER
isAuthenticated();

// Validar Url por Id válido
$id = $_GET["id"];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
  header('Location: /admin');
}

// Consulta para obtener la propiedad a actualizar
$property = Property::find($id);

// Consultar para obtener los vendedores
$query_sellers = "SELECT * FROM sellers;";
$response_sellers = mysqli_query($db_connect, $query_sellers);

// Array con mensajes de errores
$errors = Property::getErrors();

// Ejecutar el formulario después de que el usuario envía el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Asignar los atributos
  $args = $_POST['property'];
  $imageArray = $_FILES['property'];

  $property->synchronize($args);

  // Validación
  $errors = $property->validate();

  // Revisar que el array de errors esté vacío y si lo está proceder a guardar en DB
  if (empty($errors)) {
    // Subida de archivos al servidor (Si hay cambio de imagen)
    if ($imageArray['tmp_name']['image']) {
      // Obtener la extension
      $extension = pathinfo($imageArray['name']['image'])['extension'];
      // Generar un nombre único
      $imageName = md5(uniqid(rand(), true)) . '.' . $extension;
      // Resize a la imagen con InterventionImage to: Width 800px and Height 600
      $img = InterImage::make($imageArray['tmp_name']['image']);
      $img->fit(800, 600);
      // Setear el nombre único de la imagen al atributo $image de la instancia.
      $property->setImage($imageName);
      // Almacenar la imagen
      $img->save(IMAGES_FOLDER . $imageName);
    }

    // Actualizar en la base de datos
    $property->save();
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

    <?php include '../../includes/templates/form_properties.php'; ?>

    <input type="submit" value="Actualizar Propiedad" class="boton boton-verde" />
  </form>
</main>

<?php incluirTemplate('footer'); ?>