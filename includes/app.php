<?php
require 'functions.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

use App\ActiveRecord;

// Connect to DB
$db_connect = connectDB(); // TODO: Comprobar si se debe eliminar.

ActiveRecord::setDB($db_connect);
