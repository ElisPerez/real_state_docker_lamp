<?php
// Functions
require '../../includes/app.php';

use App\Property;
use App\Seller;
// Import InterventionImage
use Intervention\Image\ImageManagerStatic as InterImage;

// SESION DEL USER
isAuthenticated();

$property = new Property;

// Consulta para obtener todos los vendedores
$sellers = Seller::all();

// Array con mensajes de errores
$errors = Property::getErrors(); // Accede a un metodo static de la clase Property que al ser static no hay necesidad de instanciar la clase.

// Ejecutar el formulario después de que el usuario envía el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Create new instance
  $property = new Property($_POST['property']);
  $imageArray = $_FILES['property'];

  if ($imageArray['tmp_name']['image']) {
    // Obtener la extension
    $extension = pathinfo($imageArray['name']['image'])['extension'];
    // Generar un nombre único
    $imageName = md5(uniqid(rand(), true)) . '.' . $extension;
    // Resize a la imagen con InterventionImage to: Width 800px and Height 600
    $img = InterImage::make($imageArray['tmp_name']['image']);
    $img->fit(800, 600);

    // Setear el nombre único de la imagen al atributo $image de la instancia en memoria.
    $property->setImage($imageName);
  }
  /** VALIDATE */
  $errors = $property->validate();

  // Revisar que el array de errors esté vacío
  if (empty($errors)) {
    /** SUBIDA DE ARCHIVOS */
    // Verificar si ya existe la carpeta 'images' y sinó crearla
    if (!is_dir(IMAGES_FOLDER)) {
      mkdir(IMAGES_FOLDER);
    }
    // Save image to server
    $img->save(IMAGES_FOLDER . $imageName);

    // Save to DB
    $property->save();
  }
}

incluirTemplate('header');
?>

<main class="contenedor seccion">
  <h1>Crear</h1>

  <a href="/admin" class="boton boton-primary">Volver</a>

  <?php foreach ($errors as $error) : ?>

    <div class="alert error">
      <?php echo $error; ?>
    </div>

  <?php endforeach; ?>

  <form action="/admin/properties/create.php" method="POST" class="formulario" enctype="multipart/form-data">

    <?php include '../../includes/templates/form_properties.php'; ?>

    <input type="submit" value="Crear Propiedad" class="boton boton-primary" />
  </form>
</main>

<?php incluirTemplate('footer'); ?>