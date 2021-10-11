<?php
$desired_diet = function ($survey) {
    ob_start();
?>

    <div class="flex"><label>¿Te han diagnosticado intolerancia o alergia a algún alimento?: </label></div>
    <div class="flex"><input required type="text" name="intolerancia_txt" id="intolerancia_txt" value="<?= $survey->getintolerancia_txt(); ?>"></div>
    <div class="flex"><label>¿Sigues dieta ovolactovegetariana o vegana?: </label></div>
    <div class="flex"><input required type="text" name="vegetariana_txt" id="vegetariana_txt" value="<?= $survey->getvegetariana_txt(); ?>"></div>
    <div class="flex"><label>Indícanos alimentos que no te hacen mucha gracia: </label></div>
    <div class="flex"><input required type="text" name="sin_gracia" id="sin_gracia" value="<?= $survey->getsin_gracia(); ?>"></div>
    <div class="flex"><label>Ahora dinos qué alimentos o platos te encantan: </label></div>
    <div class="flex"><input required type="text" name="con_gracia" id="con_gracia" value="<?= $survey->getcon_gracia(); ?>"></div>
    <div class="flex"><label>¿Te llevas la comida al trabajo?: </label></div>
    <div class="flex-row">
        <fieldset>
            <label><input required type="radio" name="trabajo" value="1" <?= ($survey->gettrabajo() == 1) ? "checked" : ""; ?>>Nunca o casi nunca</label>
            <label><input required type="radio" name="trabajo" value="2" <?= ($survey->gettrabajo() == 2) ? "checked" : ""; ?>>Siempre</label>
            <label><input required type="radio" name="trabajo" value="3" <?= ($survey->gettrabajo() == 3) ? "checked" : ""; ?>>Varias veces a la semana</label>
        </fieldset>
    </div>
    <div class="flex"><label>¿Prefieres tener un primer plato y un segundo, o un plato único que aúne todo?: </label></div>
    <div class="flex-row">
        <fieldset>
            <label><input required type="radio" name="unico" value="1" <?= ($survey->getunico() == 1) ? "checked" : ""; ?>>Primero y segundo</label>
            <label><input required type="radio" name="unico" value="2" <?= ($survey->getunico() == 2) ? "checked" : ""; ?>>Plato único</label>
            <label><input required type="radio" name="unico" value="3" <?= ($survey->getunico() == 3) ? "checked" : ""; ?>>Me da igual</label>
        </fieldset>
    </div>
    <div class="flex"><label>¿Se nos olvida preguntarte algo? ¿Hay algo que nos quieras comentar o puntualizar? ¡Ahora es el momento!: </label></div>
    <div class="flex"><input required type="text" name="comentarios" id="comentarios" value="<?= $survey->getcomentarios(); ?>"></div>

<?php
    return ob_get_clean();
};
