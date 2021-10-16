<?php
$comments = function ($survey) {
    ob_start();

?>
    <div class="flex">
        <textarea name="comentarios" id="comentarios" value="<?= $survey->getcomentarios(); ?>" class="w-full h-52">
        <?= $survey->getcomentarios(); ?>
        </textarea>
    </div>
<?php
    return ob_get_clean();
};
