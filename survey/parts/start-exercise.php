<?php
$exercise = function ($survey) {
    ob_start();
?>

    <h2 class="text-blue-400">Actividad física</h2>
    <div class="flex"><label>Según tú, tu rutina diaria es: </label></div>
    <div class="flex-row">
        <fieldset>
            <label><input type="radio" name="rutina" value="1" <?= ($survey->getrutina() == 1) ? "checked" : ""; ?>>Activa o muy activa</label>
            <label><input type="radio" name="rutina" value="2" <?= ($survey->getrutina() == 2) ? "checked" : ""; ?>>Más bien sedentaria</label>
        </fieldset>
    </div>
    <div class="flex"><label>¿Cuántas horas pasas en la cama, estés o no durmiendo?: </label></div>
    <div class="flex-row">
        <fieldset>
            <label><input type="radio" name="cama" value="1" <?= ($survey->getcama() == 1) ? "checked" : ""; ?>>Menos de 6 horas</label>
            <label><input type="radio" name="cama" value="2" <?= ($survey->getcama() == 2) ? "checked" : ""; ?>>Entre 6 y 8 horas</label>
            <label><input type="radio" name="cama" value="3" <?= ($survey->getcama() == 3) ? "checked" : ""; ?>>Entre 8 y 10 horas</label>
            <label><input type="radio" name="cama" value="4" <?= ($survey->getcama() == 4) ? "checked" : ""; ?>>Más de 10 horas</label>
        </fieldset>
    </div>
    <div class="flex"><label>¿Cuánto caminas cada día?: </label></div>
    <div class="flex-row">
        <fieldset>
            <label><input type="radio" name="caminar" value="1" <?= ($survey->getcaminar() == 1) ? "checked" : ""; ?>>Entre media y una hora</label>
            <label><input type="radio" name="caminar" value="2" <?= ($survey->getcaminar() == 2) ? "checked" : ""; ?>>Entre una y dos horas</label>
            <label><input type="radio" name="caminar" value="3" <?= ($survey->getcaminar() == 3) ? "checked" : ""; ?>>Más de dos horas</label>
        </fieldset>
    </div>
    <div class="flex"><label>¿Haces deporte regularmente?: </label></div>
    <div class="flex-row">
        <fieldset>
            <label><input type="radio" name="deporte" value="1" <?= ($survey->getdeporte() == 1) ? "checked" : ""; ?>>Si</label>
            <label><input type="radio" name="deporte" value="2" <?= ($survey->getdeporte() == 2) ? "checked" : ""; ?>>No</label>
        </fieldset>
    </div>
    <div class="flex"><label>Cuéntanos qué haces, ¿cuánto tiempo y cuántas veces a la semana haces deporte?: </label></div>
    <div class="flex"><input type="text" name="deporte_txt" id="deporte_txt" value="<?= $survey->getdeporte_txt(); ?>"></div>

<?php
    return ob_get_clean();
};
