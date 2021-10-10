<?php
$send = function () {
    ob_start();
?>
    <input type="submit" name="submit" value="Guardar" class="flex p-3 my-2 bg-red-400 justify-end  text-white  rounded-xl">

<?php
    return ob_get_clean();
};
