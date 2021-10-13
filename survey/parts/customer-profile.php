<?php
$customer_profile = function ($customer) {
    global $wp_locale;
    $f_nacimiento = $customer->getNacimiento();
    list($dia, $mes, $anio) = explode("/", ($customer->getId() != null) ? "$f_nacimiento/" : "0/0/0");
    ob_start();
?>
    <div id="customer-profile">

        <h2 class="text-blue-400">Edad y sexo</h2>
        <div class="flex"><label>nacimiento:</label></div>
        <div class="flex">
            <select name="dia" id = "dia" required>
                <option value="">Día</option>
                <?php for ($i = 1; $i <= 31; $i++) : ?>
                    <option value="<?= $i; ?>" <?= (($dia == $i) ? 'selected="selected"' : ''); ?>> <?= $i; ?> </option>
                <?php endfor; ?>
            </select>
            <select name="mes" id = "mes" required>
                <option value="">Mes</option>
                <?php for ($i = 1; $i <= 12; $i++) : ?>
                    <option value="<?= $i; ?>" <?= (($mes == $i) ? 'selected="selected"' : ''); ?>><?= $wp_locale->get_month($i) ?></option>
                <?php endfor; ?>
            </select>
            <select name="anio" id = "anio" required>
                <option value="">Año</option>
                <?php for ($i = date('Y') - 17; $i >= 1900; $i--) : ?>
                    <option value="<?= $i; ?>" <?= (($anio == $i) ? 'selected="selected"' : ''); ?>> <?= $i ?> </option>
                <?php endfor; ?>
            </select>
            <input type="hidden" name="nacimiento" id="nacimiento" value="<?= $customer->getNacimiento(); ?>" required>
        </div>
        <div class="flex"><label>Sexo: </label></div>
        <div class="flex-row">
            <fieldset>
                <label><input type="radio" name="sexo" value="0" onchange="toggleWomanQuestions();" <?= ($customer->getSexo() === 0 ) ? "checked" : ""; ?> required>Hombre</label>
                <label><input type="radio" name="sexo" value="1" onchange="toggleWomanQuestions();" <?= ($customer->getSexo() === 1) ? "checked" : ""; ?> required>Mujer</label>
            </fieldset>
        </div>
    </div>
<?php
    return ob_get_clean();
};
