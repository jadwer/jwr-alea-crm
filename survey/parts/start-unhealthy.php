<?php
$unhealthy = function ($survey) {
    ob_start();
?>

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
