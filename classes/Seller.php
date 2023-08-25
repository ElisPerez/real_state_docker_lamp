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
}
