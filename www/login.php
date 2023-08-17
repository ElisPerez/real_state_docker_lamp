<?php
require 'includes/functions.php';
incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
  <h1>Iniciar Sesión</h1>
  <form class="formulario">
    <fieldset>
      <legend>Email y Password</legend>

      <label for="email">E-mail</label>
      <input type="email" name="email" id="email" placeholder="Tu Email" />

      <label for="password">Password</label>
      <input type="password" name="password" id="password" placeholder="Tu Password" />

      <input type="submit" value="Iniciar Sesión" class="boton boton-verde"/>
    </fieldset>
  </form>
</main>

<?php

incluirTemplate('footer');

?>