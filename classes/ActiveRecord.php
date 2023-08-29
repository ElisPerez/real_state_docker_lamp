<?php

namespace App;

class ActiveRecord
{
  // self para static y this para public

  // Database
  protected static $db;
  protected static $columnsDB = [];
  protected static $table = '';

  // Validations Errors
  protected static $errors = [];

  // Atributos (Se deben deblarar explicitamente para evitar errores de la extension)
  public $id;
  public $image;

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
    $query  = "INSERT INTO " . static::$table . " (";
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

    $query  = "UPDATE " . static::$table . " SET ";
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
    $query = "DELETE FROM " . static::$table . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
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
    foreach (static::$columnsDB as $column) {
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
    return static::$errors; // self porque es un static. This para un public
  }

  public function validate()
  {
    static::$errors = [];
    return static::$errors;
  }

  // Lista todos los registros
  public static function all()
  {
    $query = "SELECT * FROM " . static::$table;

    $result_set = self::querySQL($query);

    return $result_set;
  }

  // Obtiene determinado número de registros
  public static function get($quantity)
  {
    $query = "SELECT * FROM " . static::$table . " LIMIT " . $quantity;
    $result_set = self::querySQL($query);
    // debugging($result_set);

    return $result_set;
  }

  // Obtener registro por id
  public static function find($id)
  {
    $query = "SELECT * FROM " . static::$table . " WHERE id = ${id}";
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
      $array[] = static::createObject($row);
    }

    // Liberar la memoria
    $result_set->free();

    // Retornar los resultados
    return $array;
  }

  protected static function createObject($row)
  {
    $object = new static; // Crea una nueva instancia dentro de nuestra clase

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
