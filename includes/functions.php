<?php
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCTIONS_URL', __DIR__ . '/functions.php');

function incluirTemplate(string $nombre, bool $inicio = false)
{
  include TEMPLATES_URL . "/${nombre}.php";
}

function isAuthenticated(): bool
{
  // SESION DEL USER
  session_start();

  $auth = $_SESSION['login'];

  if ($auth) {
    return true;
  }
  return false;
}
