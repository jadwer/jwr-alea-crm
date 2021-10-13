<?php
$weight_evolution = function ($survey) {
    ob_start();
?>

    <h2 class="text-blue-400">Evolucion de tu peso</h2>
    <div class="flex"><label>Durante tu infancia y adolescencia tu peso era : </label></div>
    <div class="flex-row">
        <fieldset>
            <label><input required type="radio" name="peso_infancia" value="1" <?= ($survey->getpeso_infancia() == 1) ? "checked" : ""; ?>>Adecuado</label>
            <label><input required type="radio" name="peso_infancia" value="2" <?= ($survey->getpeso_infancia() == 2) ? "checked" : ""; ?>>Alto o muy alto</label>
            <label><input required type="radio" name="peso_infancia" value="3" <?= ($survey->getpeso_infancia() == 3) ? "checked" : ""; ?>>Bajo o muy bajo</label>
        </fieldset>
    </div>
    <div class="flex"><label>Ya en la edad adulta, tu peso más estable ha sido : </label></div>
    <div class="flex"><input required type="text" name="peso_adulto_estable" id="peso_adulto_estable" value="<?= $survey->getpeso_adulto_estable(); ?>"></div>
    <div class="flex"><label>Tu peso mínimo (edad adulta) ha sido: </label></div>
    <div class="flex"><input required type="text" name="peso_adulto_minimo" id="peso_adulto_minimo" value="<?= $survey->getpeso_adulto_minimo(); ?>"></div>
    <div class="flex"><label>Tu peso máximo (edad adulta) ha sido: </label></div>
    <div class="flex"><input required type="text" name="peso_adulto_maximo" id="peso_adulto_maximo" value="<?= $survey->getpeso_adulto_maximo(); ?>"></div>
    <div class="flex"><label>En el último año tu peso: </label></div>
    <div class="flex-row">
        <fieldset>
            <label><input required type="radio" name="peso_ultimo" value="1" <?= ($survey->getpeso_ultimo() == 1) ? "checked" : ""; ?>>Ha aumetado</label>
            <label><input required type="radio" name="peso_ultimo" value="2" <?= ($survey->getpeso_ultimo() == 2) ? "checked" : ""; ?>>Se ha mantenido</label>
            <label><input required type="radio" name="peso_ultimo" value="3" <?= ($survey->getpeso_ultimo() == 3) ? "checked" : ""; ?>>Ha disminuído</label>
        </fieldset>
    </div>
    <div class="flex"><label>¿Ha hecho dieta de adelgazamiento en el último año?: </label></div>
    <div class="flex-row">
        <fieldset>
            <label><input required type="radio" name="dieta_ultimo" value="1" <?= ($survey->getdieta_ultimo() == 1) ? "checked" : ""; ?>>Si</label>
            <label><input required type="radio" name="dieta_ultimo" value="2" <?= ($survey->getdieta_ultimo() == 2) ? "checked" : ""; ?>>No</label>
        </fieldset>
    </div>
    <div id="women_pregnant">
        <div class="flex"><label>¿Haz estado embarazada?: </label></div>
        <div class="flex-row">
            <fieldset>
                <label><input required type="radio" name="embarazada" onchange="togglePregnantQuestions()" value="1" <?= ($survey->getembarazada() == 1) ? "checked" : ""; ?>>Si</label>
                <label><input required type="radio" name="embarazada" onchange="togglePregnantQuestions()" value="2" <?= ($survey->getembarazada() == 2) ? "checked" : ""; ?>>No</label>
            </fieldset>
        </div>
    </div>
    <div id="pregnant_true">
        <div class="flex"><label>¿Cuántos kilos incrementaste de media?: </label></div>
        <div class="flex-row">
            <fieldset>
                <label><input  type="radio" name="embarazada_kilos" value="1" <?= ($survey->getembarazada_kilos() == 1) ? "checked" : ""; ?>>12 kg o menos</label>
                <label><input type="radio" name="embarazada_kilos" value="2" <?= ($survey->getembarazada_kilos() == 2) ? "checked" : ""; ?>>Más de 12 kg</label>
            </fieldset>
        </div>
        <div class="flex"><label>¿Recuperaste luego el peso anterior al embarazo? </label></div>
        <div class="flex-row">
            <fieldset>
                <label><input  type="radio" name="embarazada_anterior" value="1" <?= ($survey->getembarazada_anterior() == 1) ? "checked" : ""; ?>>Si</label>
                <label><input  type="radio" name="embarazada_anterior" value="2" <?= ($survey->getembarazada_anterior() == 2) ? "checked" : ""; ?>>No</label>
            </fieldset>
        </div>
        <div class="flex"><label>¿Estás dando actualmente el pecho? </label></div>
        <div class="flex-row">
            <fieldset>
                <label><input  type="radio" name="embarazada_pecho" onchange="togglePecho()" value="1" <?= ($survey->getembarazada_pecho() == 1) ? "checked" : ""; ?>>Si</label>
                <label><input  type="radio" name="embarazada_pecho" onchange="togglePecho()" value="2" <?= ($survey->getembarazada_pecho() == 2) ? "checked" : ""; ?>>No</label>
            </fieldset>
        </div>
        <div id="pecho">
            <div class="flex"><label>¿Qué tiempo tiene el bebé al que estás dando el pecho?</label></div>
            <div class="flex"><input  type="text" name="embarazada_tiempo_bebe" id="embarazada_tiempo_bebe" value="<?= $survey->getembarazada_tiempo_bebe(); ?>"></div>
        </div>
    </div>
    <div class="flex"><label>Según tu, ¿Cuál es la principal causa de tus kilos de más?: </label></div>
    <div class="flex-row">
        <fieldset>
            <label><input required type="radio" name="causa_kilos" value="1" <?= ($survey->getcausa_kilos() == 1) ? "checked" : ""; ?>>Alimentación muy desordenada</label>
            <label><input required type="radio" name="causa_kilos" value="2" <?= ($survey->getcausa_kilos() == 2) ? "checked" : ""; ?>>Picoteos entre horas</label>
            <label><input required type="radio" name="causa_kilos" value="3" <?= ($survey->getcausa_kilos() == 3) ? "checked" : ""; ?>>Comidas o cenas muy abundantes</label>
            <label><input required type="radio" name="causa_kilos" value="4" <?= ($survey->getcausa_kilos() == 4) ? "checked" : ""; ?>>No lo sé</label>
        </fieldset>
    </div>
    <div class="flex"><label>¿En qué peso crees tu que estarías más cómodo?: </label></div>
    <div class="flex"><input required type="text" name="peso_comodo" id="peso_comodo" value="<?= $survey->getpeso_comodo(); ?>"></div>
<?php
    return ob_get_clean();
};
