<?php
$pathology = function ($survey) {
    ob_start();
?>

    <h2 class="text-blue-400">Patologías, medicación, operaciones</h2>
    <div class="flex"><label>Hablando de tu estado general de salud, ¿tienes alguna patología?: </label></div>
    <div class="flex-row">
        <fieldset>
            <label><input required type="radio" name="estado_general" value="1" <?= ($survey->getestado_general() == 1) ? "checked" : ""; ?>>Si</label>
            <label><input required type="radio" name="estado_general" value="2" <?= ($survey->getestado_general() == 2) ? "checked" : ""; ?>>No</label>
        </fieldset>
    </div>
    <div class="flex"><label>Explícate: </label></div>
    <div class="flex"><input required type="text" name="estado_general_txt" id="estado_general_txt" value="<?= $survey->getestado_general_txt(); ?>"></div>
    <div class="flex"><label>¿Estás tomando algún medicamento de forma habitual?: </label></div>
    <div class="flex-row">
        <fieldset>
            <label><input required type="radio" name="medicamento" value="1" <?= ($survey->getmedicamento() == 1) ? "checked" : ""; ?>>Si</label>
            <label><input required type="radio" name="medicamento" value="2" <?= ($survey->getmedicamento() == 2) ? "checked" : ""; ?>>No</label>
        </fieldset>
    </div>
    <div class="flex"><label>Cuéntanos: </label></div>
    <div class="flex"><input required type="text" name="medicamento_txt" id="medicamento_txt" value="<?= $survey->getmedicamento_txt(); ?>"></div>
    <div class="flex"><label>¿Has pasado por el quirófano alguna vez?: </label></div>
    <div class="flex-row">
        <fieldset>
            <label><input required type="radio" name="quirofano" value="1" <?= ($survey->getquirofano() == 1) ? "checked" : ""; ?>>Si</label>
            <label><input required type="radio" name="quirofano" value="2" <?= ($survey->getquirofano() == 2) ? "checked" : ""; ?>>No</label>
        </fieldset>
    </div>
    <div class="flex"><label>Explícate: </label></div>
    <div class="flex"><input required type="text" name="quirofano_txt" id="quirofano_txt" value="<?= $survey->getquirofano_txt(); ?>"></div>
    <div class="flex"><label>¿Cómo son tus reglas?: </label></div>
    <div class="flex-row">
        <fieldset>
            <label><input required type="radio" name="reglas" value="1" <?= ($survey->getreglas() == 1) ? "checked" : ""; ?>>Regulares</label>
            <label><input required type="radio" name="reglas" value="2" <?= ($survey->getreglas() == 2) ? "checked" : ""; ?>>Irregulares</label>
            <label><input required type="radio" name="reglas" value="3" <?= ($survey->getreglas() == 3) ? "checked" : ""; ?>>Ya no tengo la regla</label>
        </fieldset>
    </div>
    <div class="flex"><label>Tu tensión arterial es: </label></div>
    <div class="flex"><input required type="text" name="tension" id="tension" value="<?= $survey->gettension(); ?>"></div>
    <div class="flex"><label>¿Cómo son tus digestiones?: </label></div>
    <div class="flex-row">
        <fieldset>
            <label><input required type="radio" name="digestiones" value="1" <?= ($survey->getdigestiones() == 1) ? "checked" : ""; ?>>Buenas</label>
            <label><input required type="radio" name="digestiones" value="2" <?= ($survey->getdigestiones() == 2) ? "checked" : ""; ?>>Tengo ardores</label>
            <label><input required type="radio" name="digestiones" value="3" <?= ($survey->getdigestiones() == 3) ? "checked" : ""; ?>>Tengo reflujo</label>
            <label><input required type="radio" name="digestiones" value="4" <?= ($survey->getdigestiones() == 4) ? "checked" : ""; ?>>Muy lentas</label>
        </fieldset>
    </div>
    <div class="flex"><label>¿Cómo vas al baño?: </label></div>
    <div class="flex-row">
        <fieldset>
            <label><input required type="radio" name="bano" value="1" <?= ($survey->getbano() == 1) ? "checked" : ""; ?>>Regularmente</label>
            <label><input required type="radio" name="bano" value="2" <?= ($survey->getbano() == 2) ? "checked" : ""; ?>>Sufro cierto estreñimiento si no me cuido</label>
            <label><input required type="radio" name="bano" value="3" <?= ($survey->getbano() == 3) ? "checked" : ""; ?>>Sufro estreñimiento habitualmente</label>
        </fieldset>
    </div>
    <h2 class="text-blue-400">Hábito no saludables</h2>
    <div class="flex"><label>¿Cuánto alcohol tomas a la semana?: </label></div>
    <div class="flex"><input required type="text" name="alcohol" id="alcohol" value="<?= $survey->getalcohol(); ?>"></div>
    <div class="flex"><label>¿Fumas?: </label></div>
    <div class="flex-row">
        <fieldset>
            <label><input required type="radio" name="tabaco" value="1" <?= ($survey->gettabaco() == 1) ? "checked" : ""; ?>>No</label>
            <label><input required type="radio" name="tabaco" value="2" <?= ($survey->gettabaco() == 2) ? "checked" : ""; ?>>Menos de 10 cigarrillos al día</label>
            <label><input required type="radio" name="tabaco" value="3" <?= ($survey->gettabaco() == 3) ? "checked" : ""; ?>>Más de 10 cigarrillos al día</label>
        </fieldset>
    </div>

<?php
    return ob_get_clean();
};
