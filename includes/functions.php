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