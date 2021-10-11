<?php
$body_measures = function ($survey) {
    ob_start();

?>
    <div class="flex"><label>Altura (cm): </label></div>
    <div class="flex"><input required type="text" name="altura" id="altura" value="<?= $survey->getaltura(); ?>"></div>
    <div class="flex"><label>Peso (kg): </label></div>
    <div class="flex"><input required type="text" name="peso" id="peso" value="<?= $survey->getpeso(); ?>"></div>
    <div class="flex"><label>Perímetro de cintura (cm): </label></div>
    <div class="flex"><input required type="text" name="per_ci" id="per_ci" value="<?= $survey->getper_ci(); ?>"></div>
    <div class="flex"><label>Perímetro de cadera (cm): </label></div>
    <div class="flex"><input required type="text" name="per_ca" id="per_ca" value="<?= $survey->getper_ca(); ?>"></div>
<?php
    return ob_get_clean();
};
