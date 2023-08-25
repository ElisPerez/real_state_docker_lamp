<fieldset>
  <legend>Información General</legend>

  <label for="first_name">Nombre:</label>
  <input type="text" id="first_name" name="seller[first_name]" placeholder="Nombre" value="<?php echo s($seller->first_name); ?>" />

  <label for="last_name">Apellido:</label>
  <input type="text" id="last_name" name="seller[last_name]" placeholder="Apellido" value="<?php echo s($seller->last_name); ?>" />
</fieldset>

<fieldset>
  <legend>Información Extra</legend>

  <label for="phone">Teléfono:</label>
  <input type="tel" id="phone" name="seller[phone]" placeholder="Teléfono" value="<?php echo s($seller->phone); ?>" />
</fieldset>