<?php
$customer_data = function ($customer) {
    ob_start();
?>
    <input required type="hidden" name="id" value="<?= $customer->getId(); ?>" />
    <div class="flex"><label>telefono:</label></div>
    <div class="flex"><input required type="text" name="telefono" value="<?= $customer->getTelefono(); ?>"></div>
    <div class="flex"><label>nif:</label></div>
    <div class="flex"><input required type="text" name="nif" value="<?= $customer->getNif(); ?>"></div>
    <div class="flex"><label>email:</label></div>
    <div class="flex"><input required type="text" name="email" value="<?= $customer->getEmail(); ?>"></div>
    <div class="flex"><label>nombre:</label></div>
    <div class="flex"><input required type="text" name="nombre" value="<?= $customer->getNombre(); ?>"></div>
    <div class="flex"><label>apellidos:</label></div>
    <div class="flex"><input required type="text" name="apellidos" value="<?= $customer->getApellidos(); ?>"></div>
    <div class="flex"><label>calle:</label></div>
    <div class="flex"><input required type="text" name="calle" value="<?= $customer->getCalle(); ?>"></div>
    <div class="flex"><label>numero:</label></div>
    <div class="flex"><input required type="text" name="numero" value="<?= $customer->getNumero(); ?>"></div>
    <div class="flex"><label>pisoLetra:</label></div>
    <div class="flex"><input required type="text" name="pisoLetra" value="<?= $customer->getPisoLetra(); ?>"></div>
    <div class="flex"><label>cp:</label></div>
    <div class="flex"><input required type="text" name="cp" value="<?= $customer->getCp(); ?>"></div>
    <div class="flex"><label>ciudad:</label></div>
    <div class="flex"><input required type="text" name="ciudad" value="<?= $customer->getCiudad(); ?>"></div>
    <div class="flex"><label>provincia:</label></div>
    <div class="flex"><input required type="text" name="provincia" value="<?= $customer->getProvincia(); ?>"></div>
<?php
    return ob_get_clean();
};
