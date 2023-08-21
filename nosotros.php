<?php
require 'includes/app.php';

incluirTemplate('header');
?>

<main class="contenedor seccion">
  <h1>Conoce sobre Nosotros</h1>
  <div class="contenido-nosotros">
    <div class="imagen">
      <picture>
        <source srcset="build/img/nosotros.webp" type="image/webp" />
        <source srcset="build/img/nosotros.jpg" type="image/jpeg" />
        <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros" />
      </picture>
    </div>

    <div class="texto-nosotros">
      <blockquote>25 Años de Experiencia</blockquote>

      <p>
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Maiores
        alias iusto tempora. Minus fugit, pariatur nemo aliquam itaque
        distinctio, dolore dolorem dolor accusantium cupiditate deserunt
        incidunt nihil omnis aspernatur minima sed similique exercitationem!
        Numquam totam illo sapiente iure ratione quo provident fugiat, nemo
        officia laborum consequuntur natus quae minus possimus
        exercitationem tenetur aut a adipisci eaque! Commodi totam delectus
        reiciendis, consequatur voluptate enim voluptas eos veritatis et
        beatae nesciunt voluptates blanditiis sequi magni. Provident
        voluptate, id quaerat perferendis blanditiis doloremque eveniet
        fugit placeat, labore culpa magnam quam asperiores dicta omnis a
        expedita sequi deleniti, eum officia laborum illo magni nihil!
      </p>

      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae,
        placeat pariatur at est enim corporis ipsa accusantium facere ea,
        omnis unde aut eligendi quae, officia sunt velit fuga! Hic illo ab
        minima eaque obcaecati labore commodi vitae numquam iure fugalorem
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias
        accusamus, vel quam consequuntur debitis ad soluta, ipsum eum
        aperiam cum nemo. Atque sint corporis laborum neque accusamus at ea?
        Aliquam!
      </p>
    </div>
  </div>
</main>

<section class="contenedor seccion">
  <h1>Más Sobre Nosotros</h1>
  <div class="iconos-nosotros">
    <div class="icono">
      <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy" />
      <h3>Seguridad</h3>
      <p>
        Tempore nihil officiis corporis veritatis voluptatem molestias
        expedita, officia suscipit consectetur, quas eveniet repudiandae
        voluptates. Nulla obcaecati consequatur ipsam veritatis, alias et!
      </p>
    </div>

    <div class="icono">
      <img src="build/img/icono2.svg" alt="Icono precio" loading="lazy" />
      <h3>Precio</h3>
      <p>
        Tempore nihil officiis corporis veritatis voluptatem molestias
        expedita, officia suscipit consectetur, quas eveniet repudiandae
        voluptates. Nulla obcaecati consequatur ipsam veritatis, alias et!
      </p>
    </div>

    <div class="icono">
      <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy" />
      <h3>A Tiempo</h3>
      <p>
        Tempore nihil officiis corporis veritatis voluptatem molestias
        expedita, officia suscipit consectetur, quas eveniet repudiandae
        voluptates. Nulla obcaecati consequatur ipsam veritatis, alias et!
      </p>
    </div>
  </div>
</section>

<?php incluirTemplate('footer'); ?>