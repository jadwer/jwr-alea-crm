<?php
$comments = function ($survey) {
    ob_start();

?>
    <div class="flex"><input type="text" name="comentarios" id="comentarios" value="<?= $survey->getcomentarios(); ?>"></div>
    Al hacer clic en finalizar serás redirigido a la tpv virtual de Caja Rural para proceder al pago de forma segura.
<?php
    return ob_get_clean();
};
