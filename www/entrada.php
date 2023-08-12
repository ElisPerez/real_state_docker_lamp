<?php
require 'includes/functions.php';

incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
  <h1>Guía de decoración para tu hogar</h1>

  <picture>
    <source srcset="build/img/destacada2.webp" type="image/webp" />
    <source srcset="build/img/destacada2.jpg" type="image/jpeg" />
    <img loading="lazy" src="build/img/destacada2.jpg" alt="Propiedad en venta" />
  </picture>

  <p class="informacion-meta">
    Escrito el: <span>10 August 2023</span> por: <span>Admin</span>
  </p>

  <div class="resumen-propiedad">
    <p>
      Lorem ipsum dolor, sit amet consectetur adipisicing elit. Maiores
      alias iusto tempora. Minus fugit, pariatur nemo aliquam itaque
      distinctio, dolore dolorem dolor accusantium cupiditate deserunt
      incidunt nihil omnis aspernatur minima sed similique exercitationem!
      Numquam totam illo sapiente iure ratione quo provident fugiat, nemo
      officia laborum consequuntur natus quae minus possimus exercitationem
      tenetur aut a adipisci eaque! Commodi totam delectus reiciendis,
      consequatur voluptate enim voluptas eos veritatis et beatae nesciunt
      voluptates blanditiis sequi magni. Provident voluptate, id quaerat
      perferendis blanditiis doloremque eveniet fugit placeat, labore culpa
      magnam quam asperiores dicta omnis a expedita sequi deleniti, eum
      officia laborum illo magni nihil!
    </p>

    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae,
      placeat pariatur at est enim corporis ipsa accusantium facere ea,
      omnis unde aut eligendi quae, officia sunt velit fuga! Hic illo ab
      minima eaque obcaecati labore commodi vitae numquam iure fugalorem
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias
      accusamus, vel quam consequuntur debitis ad soluta, ipsum eum aperiam
      cum nemo. Atque sint corporis laborum neque accusamus at ea? Aliquam!
    </p>
  </div>
</main>

<?php incluirTemplate('footer'); ?>