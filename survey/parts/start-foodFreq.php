<?php
$food_freq = function ($survey) {
    ob_start();
?>

    <h2 class="text-blue-400">Frecuencia de alimentos</h2>
    <div class="flex"><label>¿Cuántos lácteos tomas al día? (Si son bebidas vegetales, indícanoslo): </label></div>
    <div class="flex"><input type="text" name="leche" id="leche" value="<?= $survey->getleche(); ?>"></div>
    <div class="flex"><label>¿Cuántas veces tomas carne a la semana?: </label></div>
    <div class="flex"><input type="text" name="carne_roja" id="carne_roja" value="<?= $survey->getcarne_roja(); ?>"></div>
    <div class="flex"><label>¿Cuántas veces tomas pescado a la semana?: </label></div>
    <div class="flex"><input type="text" name="pescado" id="pescado" value="<?= $survey->getpescado(); ?>"></div>
    <div class="flex"><label>¿Cuántos huevos tomas a la semana?: </label></div>
    <div class="flex"><input type="text" name="huevos" id="huevos" value="<?= $survey->gethuevos(); ?>"></div>
    <div class="flex"><label>¿Tomas verduras y hortalizas a diario?: </label></div>
    <div class="flex"><input type="text" name="verduras" id="verduras" value="<?= $survey->getverduras(); ?>"></div>
    <div class="flex"><label>¿Cuántas piezas de fruta tomas al día?: </label></div>
    <div class="flex"><input type="text" name="fruta" id="fruta" value="<?= $survey->getfruta(); ?>"></div>
    <div class="flex"><label>¿Cuántas veces a la semana tomas legumbres?: </label></div>
    <div class="flex"><input type="text" name="legumbres" id="legumbres" value="<?= $survey->getlegumbres(); ?>"></div>
    <div class="flex"><label>¿Cuántas veces a la semana consumes patatas, pasta, arroz, quinoa, espelta…?: </label></div>
    <div class="flex"><input type="text" name="patatas" id="patatas" value="<?= $survey->getpatatas(); ?>"></div>
    <div class="flex"><label>Estima cuánto pan tomas al día (por ejemplo: medio colón, un cuarto de barra…): </label></div>
    <div class="flex"><input type="text" name="pan" id="pan" value="<?= $survey->getpan(); ?>"></div>
    <div class="flex"><label>Comida rápida: </label></div>
    <div class="flex-row">
        <fieldset>
            <label><input type="radio" name="comida_rapida" value="1" <?= ($survey->getcomida_rapida() == 1) ? "checked" : ""; ?>>Nunca</label>
            <label><input type="radio" name="comida_rapida" value="2" <?= ($survey->getcomida_rapida() == 2) ? "checked" : ""; ?>>1 o 2 veces por semana</label>
            <label><input type="radio" name="comida_rapida" value="3" <?= ($survey->getcomida_rapida() == 3) ? "checked" : ""; ?>>3 veces o más por semana</label>
        </fieldset>
    </div>
    <div class="flex"><label>Comida precocinada: </label></div>
    <div class="flex-row">
        <fieldset>
            <label><input type="radio" name="precocinada" value="1" <?= ($survey->getprecocinada() == 1) ? "checked" : ""; ?>>Nunca</label>
            <label><input type="radio" name="precocinada" value="2" <?= ($survey->getprecocinada() == 2) ? "checked" : ""; ?>>1 o 2 veces por semana</label>
            <label><input type="radio" name="precocinada" value="3" <?= ($survey->getprecocinada() == 3) ? "checked" : ""; ?>>3 veces o más por semana</label>
        </fieldset>
    </div>
    <div class="flex"><label>Snacks: </label></div>
    <div class="flex-row">
        <fieldset>
            <label><input type="radio" name="snacks" value="1" <?= ($survey->getsnacks() == 1) ? "checked" : ""; ?>>Nunca</label>
            <label><input type="radio" name="snacks" value="2" <?= ($survey->getsnacks() == 2) ? "checked" : ""; ?>>1 o 2 veces por semana</label>
            <label><input type="radio" name="snacks" value="3" <?= ($survey->getsnacks() == 3) ? "checked" : ""; ?>>3 veces o más por semana</label>
        </fieldset>
    </div>
    <div class="flex"><label>Bollería, dulces: </label></div>
    <div class="flex-row">
        <fieldset>
            <label><input type="radio" name="bolleria" value="1" <?= ($survey->getbolleria() == 1) ? "checked" : ""; ?>>Nunca</label>
            <label><input type="radio" name="bolleria" value="2" <?= ($survey->getbolleria() == 2) ? "checked" : ""; ?>>1 o 2 veces por semana</label>
            <label><input type="radio" name="bolleria" value="3" <?= ($survey->getbolleria() == 3) ? "checked" : ""; ?>>3 veces o más por semana</label>
        </fieldset>
    </div>

<?php
    return ob_get_clean();
};
