<?php
$nutrition = function ($survey) {
    ob_start();
?>

    <div class="flex"><label>¿Qué desayunas?: </label></div>
    <div class="flex"><input required type="text" name="desayunos_txt" id="desayunos_txt" value="<?= $survey->getdesayunos_txt(); ?>"></div>
    <div class="flex"><label>¿Qué tomas a media mañana?: </label></div>
    <div class="flex"><input required type="text" name="media_manana_txt" id="media_manana_txt" value="<?= $survey->getmedia_manana_txt(); ?>"></div>
    <div class="flex"><label>¿Qué meriendas?: </label></div>
    <div class="flex"><input required type="text" name="meriendas_txt" id="meriendas_txt" value="<?= $survey->getmeriendas_txt(); ?>"></div>
    <div class="flex"><label>¿Tomas algo de postre tras comer y cenar?: </label></div>
    <div class="flex"><input required type="text" name="postre_txt" id="postre_txt" value="<?= $survey->getpostre_txt(); ?>"></div>
    <div class="flex"><label>¿Comes algo desde que cenas hasta que te vas a la cama, más allá del postre?: </label></div>
    <div class="flex"><input required type="text" name="postcena_txt" id="postcena_txt" value="<?= $survey->getpostcena_txt(); ?>"></div>
    <div class="flex"><label>¿Qué bebes durante la comida y la cena?: </label></div>
    <div class="flex"><input required type="text" name="bebida_en_comidas" id="bebida_en_comidas" value="<?= $survey->getbebida_en_comidas(); ?>"></div>
    <div class="flex"><label>¿Cuántas veces a la semana comes, cenas o tapeas fuera de casa?: </label></div>
    <div class="flex"><input required type="text" name="veces_fuera_casa" id="veces_fuera_casa" value="<?= $survey->getveces_fuera_casa(); ?>"></div>
    <div class="flex"><label>¿Comes o cenas fuera de casa por trabajo?: </label></div>
    <div class="flex-row">
        <fieldset>
            <label><input required type="radio" name="fuera_casa_trabajo" value="1" <?= ($survey->getfuera_casa_trabajo() == 1) ? "checked" : ""; ?>>Nunca o casi nunca</label>
            <label><input required type="radio" name="fuera_casa_trabajo" value="2" <?= ($survey->getfuera_casa_trabajo() == 2) ? "checked" : ""; ?>>Una o dos veces al mes</label>
            <label><input required type="radio" name="fuera_casa_trabajo" value="3" <?= ($survey->getfuera_casa_trabajo() == 3) ? "checked" : ""; ?>>Varias veces a la semana</label>
        </fieldset>
    </div>
    <div class="flex"><label>Picoteas entre horas: </label></div>
    <div class="flex-row">
        <fieldset>
            <label><input required type="radio" name="picoteas" value="1" <?= ($survey->getpicoteas() == 1) ? "checked" : ""; ?>>No, nunca</label>
            <label><input required type="radio" name="picoteas" value="2" <?= ($survey->getpicoteas() == 2) ? "checked" : ""; ?>>Sí, muy habitualmente, en casa o en el trabajo</label>
            <label><input required type="radio" name="picoteas" value="3" <?= ($survey->getpicoteas() == 3) ? "checked" : ""; ?>>A veces, según temporadas</label>
        </fieldset>
    </div>
    <div class="flex"><label>¿En qué momento del día tienes más ansiedad por la comida?: </label></div>
    <div class="flex-row">
        <fieldset>
            <label><input required type="radio" name="ansiedad_comida" value="1" <?= ($survey->getansiedad_comida() == 1) ? "checked" : ""; ?>>Nunca tengo ansiedad por la comida</label>
            <label><input required type="radio" name="ansiedad_comida" value="2" <?= ($survey->getansiedad_comida() == 2) ? "checked" : ""; ?>>Por la mañana</label>
            <label><input required type="radio" name="ansiedad_comida" value="3" <?= ($survey->getansiedad_comida() == 3) ? "checked" : ""; ?>>Por la tarde</label>
            <label><input required type="radio" name="ansiedad_comida" value="4" <?= ($survey->getansiedad_comida() == 4) ? "checked" : ""; ?>>Después de cenar</label>
        </fieldset>
    </div>

<?php
    return ob_get_clean();
};
