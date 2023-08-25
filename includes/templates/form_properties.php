<fieldset>
  <legend>Información General</legend>
  <label for="title">Título:</label>
  <input type="text" id="title" name="property[title]" placeholder="Título Propiedad" value="<?php echo s($property->title); ?>" />

  <label for="price">Precio:</label>
  <input type="number" id="price" name="property[price]" placeholder="Precio Propiedad" value="<?php echo s($property->price); ?>" />

  <label for="image">Imagen:</label>
  <input type="file" id="image" name="property[image]" accept="image/jpeg image/png" />

  <?php if ($property->image) { ?>
    <img src="/images/<?php echo $property->image; ?>" alt="<?php echo $property->title; ?>" class="image-small" />
  <?php } ?>

  <label for="description">Descripción:</label>
  <div class="p-relative">
    <textarea name="property[description]" id="description"><?php echo s($property->description); ?></textarea>
    <div class="char-counter">
      <span class="char-count" id="charCount">0</span> / 1200 caracteres
    </div>
  </div>
</fieldset>

<fieldset>
  <legend>Información Propiedad</legend>

  <label for="rooms">Habitaciones:</label>
  <input type="number" id="rooms" name="property[rooms]" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($property->rooms); ?>" />

  <label for="wc">Baños:</label>
  <input type="number" id="wc" name="property[wc]" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($property->wc); ?>" />

  <label for="parking_lot">Estacionamiento:</label>
  <input type="number" id="parking_lot" name="property[parking_lot]" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($property->parking_lot); ?>" />
</fieldset>

<fieldset>
  <legend>Vendedor</legend>
  <label for="seller">Vendedor</label>
  <select name="property[seller_id]" id="seller">
    <option value="">-- Seleccione --</option>
    <?php foreach ($sellers as $seller) : ?>
      <option <?php echo $property->seller_id === $seller->id ? 'selected' : ''; ?> value="<?php echo s($seller->id); ?>"><?php echo s($seller->first_name) . " " . s($seller->last_name); ?></option>
    <?php endforeach; ?>

  </select>
</fieldset>