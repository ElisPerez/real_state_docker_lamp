<?php

namespace App;

class Property extends ActiveRecord
{
  protected static $table = 'properties';
  protected static $columnsDB = [
    'id', 'title', 'price', 'image', 'description', 'rooms', 'wc', 'parking_lot', 'create_at', 'seller_id'
  ];

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
    $this->seller_id   = $args['seller_id'] ?? '';
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
}
