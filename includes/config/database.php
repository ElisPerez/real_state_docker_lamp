<?php

function connectDB(): mysqli
{
  $host = "db"; // "db" es el nombre del servicio en docker-compose.yml
  $user = "root";
  $password = "test";
  $dbname = "realstate_crud";

  $db = new mysqli($host, $user, $password, $dbname);

  if (!$db) {
    echo "ERROR: No se pudo conectar a la base de datos";
    exit;
  }

  return $db; // Retornar una instancia de la base de datos
}
