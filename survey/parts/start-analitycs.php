<?php
$analitycs = function ($survey) {
    ob_start();
?>
    <h2 class="text-blue-400">Analíticas</h2>
    <div class="flex"><label>En tu última analítica ¿Tenías algo fuera de orden?: </label></div>
    <div class="flex-row">
        <fieldset>
            <label><input type="radio" name="ultima_analitica" value="1" <?= ($survey->getultima_analitica() == 1) ? "checked" : ""; ?>>Si</label>
            <label><input type="radio" name="ultima_analitica" value="2" <?= ($survey->getultima_analitica() == 2) ? "checked" : ""; ?>>No</label>
        </fieldset>
    </div>
    <div class="flex"><label>Explícate: </label></div>
    <div class="flex"><input type="text" name="ultima_analitica_txt" id="ultima_analitica_txt" value="<?= $survey->getultima_analitica_txt(); ?>"></div>
<?php
    return ob_get_clean();
};
