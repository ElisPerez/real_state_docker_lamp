<?php
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCTIONS_URL', __DIR__ . '/functions.php');
define('IMAGES_FOLDER', __DIR__ . '/../images/');

function incluirTemplate(string $nombre, bool $inicio = false)
{
  include TEMPLATES_URL . "/${nombre}.php";
}

function isAuthenticated(): void
{
  // SESION DEL USER
  session_start();

  if ($_SESSION['login'] && basename($_SERVER['PHP_SELF']) === 'login.php') {
    header('location: /admin');
  }

  if (!$_SESSION['login'] && basename($_SERVER['PHP_SELF']) !== 'login.php') {
    header('location: /login.php');
  }
}

function debugging($variable)
{
  echo '<pre>';
  echo var_dump($variable);
  echo '</pre>';
  exit;
}

// Sanitizar/Escapar HTML
function s($html): string
{
  $s = htmlspecialchars($html);

  return $s;
}

// Validar tipo de contenido
function validateTypeContent($type)
{
  $types = ['seller', 'property'];

  // Buscar type en types
  return in_array($type, $types);
}

// Muestra los mensajes
function showNotification($code)
{
  $message = '';

  switch ($code) {
    case 1:
      $message = 'Creado Correctamente';
      break;
    case 2:
      $message = 'Actualizado Correctamente';
      break;
    case 3:
      $message = 'Eliminado Correctamente';
      break;

    default:
      $message = false;
      break;
  }

  return $message;
}
