<?php
$seguimiento = function ($survey) {
    ob_start();

?>
    <div class="flex"><label>¿Has hecho la dieta de forma estricta, a tu parecer?: </label></div>
    <div class="flex-row">
        <input required type="radio" name="estricta" value="1" <?= ($survey->getestricta() == 1) ? "checked" : ""; ?>><label>En general, sí</label>
        <input required type="radio" name="estricta" value="2" <?= ($survey->getestricta() == 2) ? "checked" : ""; ?>><label>En general, no</label>
        <input required type="radio" name="estricta" value="3" <?= ($survey->getestricta() == 3) ? "checked" : ""; ?>><label>Más o menos</label>
    </div>
    <div class="flex"><label>¿Has pesado los alimentos? (Recuerda que hay que hacerlo con báscula digital): </label></div>
    <div class="flex-row">
        <input required type="radio" name="pesado" value="1" <?= ($survey->getpesado() == 1) ? "checked" : ""; ?>><label>Si, siempre</label>
        <input required type="radio" name="pesado" value="2" <?= ($survey->getpesado() == 2) ? "checked" : ""; ?>><label>No siempre</label>
    </div>
    <div class="flex"><label>¿Has tenido comidas o cenas fuera de casa (restaurante, comida rápida, tapeo)?: </label></div>
    <div class="flex-row">
        <input required type="radio" name="fuera_casa" value="1" <?= ($survey->getfuera_casa() == 1) ? "checked" : ""; ?>><label>Ninguna vez</label>
        <input required type="radio" name="fuera_casa" value="2" <?= ($survey->getfuera_casa() == 2) ? "checked" : ""; ?>><label>1-2 veces</label>
        <input required type="radio" name="fuera_casa" value="3" <?= ($survey->getfuera_casa() == 3) ? "checked" : ""; ?>><label>3 veces o más</label>
    </div>
    <div class="flex"><label>¿Has picoteado entre horas fuera o dentro de casa?: </label></div>
    <div class="flex-row">
        <input required type="radio" name="picoteado" value="1" <?= ($survey->getpicoteado() == 1) ? "checked" : ""; ?>><label>Ninguna vez</label>
        <input required type="radio" name="picoteado" value="2" <?= ($survey->getpicoteado() == 2) ? "checked" : ""; ?>><label>1-2 veces</label>
        <input required type="radio" name="picoteado" value="3" <?= ($survey->getpicoteado() == 3) ? "checked" : ""; ?>><label>3 veces o más</label>
    </div>
    <div class="flex"><label>Estando en casa, ¿has cocinado cada día lo que te correspondía en la dieta?: </label></div>
    <div class="flex-row">
        <input required type="radio" name="cocinado" value="1" <?= ($survey->getcocinado() == 1) ? "checked" : ""; ?>><label>Sí, siempre</label>
        <input required type="radio" name="cocinado" value="2" <?= ($survey->getcocinado() == 2) ? "checked" : ""; ?>><label>No siempre</label>
    </div>
    <div class="flex"><label>¿Has hecho muchos cambios en la dieta que te planteamos?: </label></div>
    <div class="flex-row">
        <input required type="radio" name="cambios" value="1" <?= ($survey->getcambios() == 1) ? "checked" : ""; ?>><label>Ninguna vez</label>
        <input required type="radio" name="cambios" value="2" <?= ($survey->getcambios() == 2) ? "checked" : ""; ?>><label>1-2 veces</label>
        <input required type="radio" name="cambios" value="3" <?= ($survey->getcambios() == 3) ? "checked" : ""; ?>><label>3 veces o más</label>
    </div>
    <div class="flex"><label>¿Has pasado hambre?: </label></div>
    <div class="flex-row">
        <input required type="radio" name="hambre" value="1" <?= ($survey->gethambre() == 1) ? "checked" : ""; ?>><label>En general, sí</label>
        <input required type="radio" name="hambre" value="2" <?= ($survey->gethambre() == 2) ? "checked" : ""; ?>><label>En general, no</label>
    </div>
    <div class="flex"><label>¿Has tenido ansiedad en algún momento del día?: </label></div>
    <div class="flex-row">
        <input required type="radio" name="ansiedad" value="1" <?= ($survey->getansiedad() == 1) ? "checked" : ""; ?>><label>Por norma general no</label>
        <input required type="radio" name="ansiedad" value="2" <?= ($survey->getansiedad() == 2) ? "checked" : ""; ?>><label>Algún día</label>
        <input required type="radio" name="ansiedad" value="3" <?= ($survey->getansiedad() == 3) ? "checked" : ""; ?>><label>Muchos días</label>
    </div>
    <div class="flex"><label>¿Echas de menos algún ingrediente o plato en concreto?: </label></div>
    <div class="flex"><input required type="text" name="echas_menos" id="echas_menos" value="<?= $survey->getechas_menos(); ?>"></div>
    <div class="flex"><label>¿Te han gustado en general las recetas de la dieta anterior?: </label></div>
    <div class="flex-row">
        <input required type="radio" name="gustado" value="1" <?= ($survey->getgustado() == 1) ? "checked" : ""; ?>><label>En general, sí</label>
        <input required type="radio" name="gustado" value="2" <?= ($survey->getgustado() == 2) ? "checked" : ""; ?>><label>En general, no</label>
    </div>
    <div class="flex"><label>¿Qué no te ha gustado?: </label></div>
    <div class="flex"><input required type="text" name="gustado_txt" id="gustado_txt" value="<?= $survey->getgustado_txt(); ?>"></div>
    <div class="flex"><label>¿Estás a gusto con las comidas menores (desayuno, media mañana y merienda)?: </label></div>
    <div class="flex-row">
        <input required type="radio" name="menores" value="1" <?= ($survey->getmenores() == 1) ? "checked" : ""; ?>><label>Sí</label>
        <input required type="radio" name="menores" value="2" <?= ($survey->getmenores() == 2) ? "checked" : ""; ?>><label>No</label>
    </div>
    <div class="flex"><label>¿Qué no te ha gustado?: </label></div>
    <div class="flex"><input required type="text" name="menores_txt" id="menores_txt" value="<?= $survey->getmenores_txt(); ?>"></div>
    <div class="flex"><label>¿Qué tal tus digestiones?: </label></div>
    <div class="flex-row">
        <input required type="radio" name="digestiones" value="1" <?= ($survey->getdigestiones() == 1) ? "checked" : ""; ?>><label>Buenas</label>
        <input required type="radio" name="digestiones" value="2" <?= ($survey->getdigestiones() == 2) ? "checked" : ""; ?>><label>Malas</label>
    </div>
    <div class="flex"><label>¿Qué tal has ido al baño?: </label></div>
    <div class="flex-row">
        <input required type="radio" name="bano" value="1" <?= ($survey->getbano() == 1) ? "checked" : ""; ?>><label>Bien</label>
        <input required type="radio" name="bano" value="2" <?= ($survey->getbano() == 2) ? "checked" : ""; ?>><label>Más o menos</label>
        <input required type="radio" name="bano" value="3" <?= ($survey->getbano() == 3) ? "checked" : ""; ?>><label>Mal</label>
    </div>
    <div class="flex"><label>¿Has hecho ejercicio?: </label></div>
    <div class="flex-row">
        <input required type="radio" name="ejercicio" value="1" <?= ($survey->getejercicio() == 1) ? "checked" : ""; ?>><label>Ninguna vez</label>
        <input required type="radio" name="ejercicio" value="2" <?= ($survey->getejercicio() == 2) ? "checked" : ""; ?>><label>1-2 veces por semana</label>
        <input required type="radio" name="ejercicio" value="3" <?= ($survey->getejercicio() == 3) ? "checked" : ""; ?>><label>3 veces o más por semana</label>
    </div>
<?php
    return ob_get_clean();
};
