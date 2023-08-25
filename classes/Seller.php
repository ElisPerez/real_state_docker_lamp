<?php

namespace App;

class Seller extends ActiveRecord
{
  protected static $table = 'sellers';
  protected static $columnsDB = ['id', 'first_name', 'last_name', 'phone'];

  public $id;
  public $first_name;
  public $last_name;
  public $phone;

  public function __construct($args = [])
  {
    $this->id          = $args['id'] ?? null;
    $this->first_name       = $args['first_name'] ?? '';
    $this->last_name       = $args['last_name'] ?? '';
    $this->phone       = $args['phone'] ?? '';
  }

  public function validate()
  {
    if (!$this->first_name) {
      self::$errors[] = 'El nombre es obligatorio';
    }

    if (!$this->last_name) {
      self::$errors[] = 'El apellido es obligatorio';
    }

    if (!$this->phone) {
      self::$errors[] = 'El teléfono es obligatorio';
    }

    if (!preg_match('/[0-9]{10}/', $this->phone)) {
      self::$errors[] = 'Formato no válido';
    }

    return self::$errors;
  }
}
