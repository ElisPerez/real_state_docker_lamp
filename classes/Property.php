<?php

namespace App;

class Property
{
  // self para static y this para public

  // Database
  protected static $db;
  protected static $columnsDB = [
    'id', 'title', 'price', 'image', 'description', 'rooms', 'wc', 'parking_lot', 'create_at', 'seller_id'
  ];

  // Validations Errors
  protected static $errors = [];

  public $id;
  public $title;
  public $price;
  public $image;
  public $description;
  public $rooms;
  public $wc;
  public $parking_lot;
  public $create_at;
  public $seller_id;

  public function __construct($args = [])
  {
    $this->id          = $args['id'] ?? null;
    $this->title       = $args['title'] ?? '';
    $this->price       = $args['price'] ?? '';
    $this->image       = $args['image'] ?? '';
    $this->description = $args['description'] ?? '';
    $this->rooms       = $args['rooms'] ?? '';
    $this->wc          = $args['wc'] ?? '';
    $this->parking_lot = $args['parking_lot'] ?? '';
    $this->create_at   = date('Y/m/d');
    $this->seller_id   = $args['seller_id'] ?? '1';
  }

  // Definir la conexion a la DB
  public static function setDB($database)
  {
    self::$db = $database;
  }

  public function save()
  {
    if (!is_null($this->id)) {
      // Actualizando
      $this->update();
    } else {
      // Creando nuevo registro
      $this->create();
    }
  }

  public function create()
  {
    // Sanitizar los datos
    $attributes = $this->sanitizingData();
    $columnString = join(', ', array_keys($attributes));
    $valuesString = join("', '", array_values($attributes));

    // Insertar en la base de datos
    $query  = "INSERT INTO properties (";
    $query .= $columnString;
    $query .= ") VALUES ('";
    $query .= $valuesString;
    $query .= "');";

    $result_set = self::$db->query($query);
    // Redireccionar al usuario
    if ($result_set) {
      header('Location: /admin?result=1');
    }
  }

  public function update()
  {
    // Sanitizar los datos
    $attributes = $this->sanitizingData();

    $values = [];

    foreach ($attributes as $key => $value) {
      $values[] = "{$key}='{$value}'";
    }

    $query  = "UPDATE properties SET ";
    $query .= join(', ', $values);
    $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
    $query .= " LIMIT 1 ";

    $result_set = self::$db->query($query);

    if ($result_set) {
      // Redireccionar al usuario
      header('Location: /admin?result=2');
    }
  }

  // Eliminar registro en DB
  public function delete()
  {
    $query = "DELETE FROM properties WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
    $result_set = self::$db->query($query);

    if ($result_set) {
      $this->deleteImage();

      header('location: /admin?result=3');
    }
  }

  // Identificar y unir los atributos de la DB
  public function attributes(): array
  {
    $attributes = [];
    foreach (self::$columnsDB as $column) {
      if ($column === 'id') continue;
      $attributes[$column] = $this->$column;
    }

    return $attributes;
  }

  public function sanitizingData()
  {
    $attributes = $this->attributes();
    $sanitized = [];

    foreach ($attributes as $key => $value) {
      $sanitized[$key] = self::$db->escape_string($value);
    }

    return $sanitized;
  }

  // Subida de archivos
  public function setImage($image)
  {
    // Elimina la imagen previa
    if (!is_null($this->id)) {
      $this->deleteImage();
    }

    // Asignar al atributo $image el nombre de la imagen => 'myphoto.jpg'
    if ($image) {
      $this->image = $image;
    }
  }

  // Eliminar archivo
  public function deleteImage()
  {
    // Comprobar si existe el archivo
    $isExist = file_exists(IMAGES_FOLDER . $this->image);
    if ($isExist) {
      unlink(IMAGES_FOLDER . $this->image);
    }
  }

  // Validations
  public static function getErrors()
  {
    return self::$errors; // self porque es un static. This para un public
  }

  public function validate()
  {
    if (!$this->title) {
      // Agregar elementos a un array
      self::$errors[] = "Debes añadir un título";
    }

    if (!$this->price) {
      self::$errors[] = "El precio es obligatorio";
    }

    if (strlen($this->description) < 50) {
      self::$errors[] = "La descripción es obligatoria y debe tener al menos 50 carácteres";
    }

    if (!$this->rooms) {
      self::$errors[] = 'Habitaciones es obligatorio';
    }

    if (!$this->wc) {
      self::$errors[] = 'Baños es obligatorio';
    }

    if (!$this->parking_lot) {
      self::$errors[] = 'Estacionamiento es obligatorio';
    }

    if (!$this->seller_id) {
      self::$errors[] = 'Vendedor es obligatorio';
    }

    if (!$this->image) {
      self::$errors[] = 'La imagen es obligatoria';
    }

    return self::$errors;
  }

  // Lista todos los registros
  public static function all()
  {
    $query = "SELECT * FROM properties";

    $result_set = self::querySQL($query);

    return $result_set;
  }

  // Obtener registro por id
  public static function find($id)
  {
    $query = "SELECT * FROM properties WHERE id = ${id}";
    $result_set = self::querySQL($query);
    return array_shift($result_set);
  }

  public static function querySQL($query)
  {
    // Consultar la DB
    $result_set = self::$db->query($query);

    // Iterar los resultados
    $array = [];
    while ($row = $result_set->fetch_assoc()) {
      $array[] = self::createObject($row);
    }

    // Liberar la memoria
    $result_set->free();

    // Retornar los resultados
    return $array;
  }

  protected static function createObject($row)
  {
    $object = new self; // Crea una nueva instancia dentro de nuestra clase

    foreach ($row as $key => $value) {
      if (property_exists($object, $key)) {
        $object->$key = $value;
      }
    }

    return $object;
  }

  // Sincronizar el objeto en memoria con los datos que está haciendo el usuario
  public function synchronize($args = [])
  {
    foreach ($args as $key => $value) {
      if (property_exists($this, $key) && !is_null($value)) {
        $this->$key = $value;
      }
    }
  }
}
