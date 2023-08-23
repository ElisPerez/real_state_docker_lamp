<fieldset>
  <legend>Información General</legend>
  <label for="title">Título:</label>
  <input type="text" id="title" name="title" placeholder="Título Propiedad" value="<?php echo s($property->title); ?>" />

  <label for="price">Precio:</label>
  <input type="number" id="price" name="price" placeholder="Precio Propiedad" value="<?php echo s($property->price); ?>" />

  <label for="image">Imagen:</label>
  <input type="file" id="image" name="image" accept="image/jpeg image/png" />
  <label for="description">Descripción:</label>
  <div class="p-relative">
    <textarea name="description" id="description"><?php echo s($property->description); ?></textarea>
    <div class="char-counter">
      <span class="char-count" id="charCount">0</span> / 1200 caracteres
    </div>
  </div>
</fieldset>

<fieldset>
  <legend>Información Propiedad</legend>

  <label for="rooms">Habitaciones:</label>
  <input type="number" id="rooms" name="rooms" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($property->rooms); ?>" />

  <label for="wc">Baños:</label>
  <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($property->wc); ?>" />

  <label for="parking_lot">Estacionamiento:</label>
  <input type="number" id="parking_lot" name="parking_lot" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($property->parking_lot); ?>" />
</fieldset>

<fieldset>
  <legend>Vendedor</legend>

  <select name="seller_id">
    // todo: Falta vendedores

  </select>
</fieldset>