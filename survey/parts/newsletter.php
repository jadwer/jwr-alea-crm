<?php
$newsletter = function () {
    ob_start();

?>
    <div class="flex newsletter">
        <label for="newsletter">
            <input type="checkbox" name="newsletter" id="newsletter">
            Acepto el envío de comunicaciones comerciales.</a>
        </label>
    </div>
<?php
    return ob_get_clean();
};
