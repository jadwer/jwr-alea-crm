<?php
$counter_script = function () {
    ob_start();
?>

    <script src=<?= home_url() . "/wp-content/themes/JwR-Alea/assets/js/dcounts-js.min.js"; ?>></script>
    <script type="text/javascript">
        dCounts('echas_menos', 30); 
        dCounts('gustado_txt', 30); 
        dCounts('menores_txt', 30); 
        dCounts('altura', 3);
        dCounts('peso', 3);
        dCounts('per_ci', 2);
        dCounts('per_ca', 2);        
    </script>
<?php
    return ob_get_clean();
};
