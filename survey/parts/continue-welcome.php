<?php
$welcome = function ($customer) {
    ob_start();

?>
            <div><?=$customer->getNombre();?>, ¿Cómo te ha ido?</div>
<?php
    return ob_get_clean();
};
