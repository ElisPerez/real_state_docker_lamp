<?php
require 'functions.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

use App\Property;

// Connect to DB
$db_connect = connectDB();

Property::setDB($db_connect);
