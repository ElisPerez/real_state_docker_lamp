<?php
// DataBase
require "../../includes/config/database.php";
$db_connect = conectarDB();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $title       = $_POST["title"];
  $price       = $_POST["price"];
  $image       = $_POST["image"];
  $description = $_POST["description"];
  $rooms       = $_POST["rooms"];
  $wc          = $_POST["wc"];
  $parking_lot  = $_POST["parkinglot"];
  $seller_id   = $_POST["sellerid"];

  // Insertar en la base de datos
  $query = "INSERT INTO properties (title, price, description, rooms, wc, parking_lot, seller_id) VALUES ('$title', '$price', '$description', '$rooms', '$wc', '$parking_lot', '$seller_id');";

  $result = mysqli_query($db_connect, $query);

  if ($result) {
    echo "Insertado a la base de datos correctamente";
  } else {
    echo "ERROR:";
    echo "<pre>";
    echo var_dump($result);
    echo "</pre>";
  }
}

// Functions
require '../../includes/functions.php';

incluirTemplate('header');
?>

<main class="contenedor seccion">
  <h1>Create</h1>

  <a href="/admin" class="boton boton-verde">Volver</a>

  <form action="/admin/properties/create.php" method="POST" class="formulario">
    <fieldset>
      <legend>Información General</legend>
      <label for="title">Título:</label>
      <input type="text" id="title" name="title" placeholder="Título Propiedad" />

      <label for="price">Precio:</label>
      <input type="number" id="price" name="price" placeholder="Precio Propiedad" />

      <label for="image">Imagen:</label>
      <input type="file" id="image" name="image" accept="image/jpeg image/png" />

      <label for="description">Descripción:</label>
      <textarea name="description" id="description"></textarea>
    </fieldset>

    <fieldset>
      <legend>Información Propiedad</legend>

      <label for="rooms">Habitaciones:</label>
      <input type="number" id="rooms" name="rooms" placeholder="Ej: 3" min="1" max="9" />

      <label for="wc">Baños:</label>
      <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" />

      <label for="parkinglot">Estacionamiento:</label>
      <input type="number" id="parkinglot" name="parkinglot" placeholder="Ej: 3" min="1" max="9" />
    </fieldset>

    <fieldset>
      <legend>Vendedor</legend>

      <select name="sellerid">
        <option value="1">Antonio</option>
        <option value="2">Efrain</option>
      </select>
    </fieldset>

    <input type="submit" value="Crear Propiedad" class="boton boton-verde" />
  </form>
</main>

<?php incluirTemplate('footer'); ?>