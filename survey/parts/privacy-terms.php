<?php
$privacy_terms = function () {
    ob_start();
?>
    <div class="flex terminos-privacidad">
        <label for="privacy">
            <input required type="checkbox" name="privacy" id="privacy">
            He leído y acepto la <a href="">Política de privacidad</a> y las <a hfer="">Condiciones generales de uso.</a>
        </label>
    </div>
<?php
    return ob_get_clean();
};
