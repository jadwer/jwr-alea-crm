<?php
$counter_script = function () {
    ob_start();
?>

    <script src=<?= home_url() . "/wp-content/themes/JwR-Alea/assets/js/dcounts-js.min.js"; ?>></script>
    <script type="text/javascript">
        function toggleWomanQuestions() {
            var sexo = document.getElementsByName("sexo");
            var gender = '';
            sexo.forEach((i) => {
                if (i.checked == true) gender = i.value;
            });
            if (gender == 0) {
                document.getElementById('regla_section').style.display = 'none';
                var reglas = document.getElementsByName("reglas");
                reglas.forEach((i) => {
                    i.required = false
                });
                document.getElementById('women_pregnant').style.display = 'none';
                document.getElementById('pregnant_true').style.display = 'none';
                document.getElementById('pecho').style.display = 'none';
            } else if (gender == 1) {
                document.getElementById('regla_section').style.display = 'block';
                var reglas = document.getElementsByName("reglas");
                reglas.forEach((i) => {
                    i.required = true
                });
                document.getElementById('women_pregnant').style.display = 'block';
                document.getElementById('pregnant_true').style.display = 'none';
                document.getElementById('pecho').style.display = 'none';
            }
        }

        function togglePregnantQuestions() {
            var pregnant = document.getElementsByName("embarazada");
            var answer = '';
            pregnant.forEach((i) => {
                if (i.checked == true) answer = i.value;
            });
            if (answer == 1) {
                document.getElementById('pregnant_true').style.display = 'block'
                var p_kilos = document.getElementsByName("embarazada_kilos");
                var p_anterior = document.getElementsByName("embarazada_anterior");
                var p_pecho = document.getElementsByName("embarazada_pecho");
                p_kilos.forEach((i) => {
                    i.required = true
                });
                p_anterior.forEach((i) => {
                    i.required = true
                });
                p_pecho.forEach((i) => {
                    i.required = true
                });

            } else if (answer == 2) {
                document.getElementById('pregnant_true').style.display = 'none';
                var p_kilos = document.getElementsByName("embarazada_kilos");
                var p_anterior = document.getElementsByName("embarazada_anterior");
                var p_pecho = document.getElementsByName("embarazada_pecho");
                p_kilos.forEach((i) => {
                    i.required = false
                });
                p_anterior.forEach((i) => {
                    i.required = false
                });
                p_pecho.forEach((i) => {
                    i.required = false
                });
            }
        }

        function togglePecho() {
            var radios = document.getElementsByName("embarazada_pecho");
            var answer = '';
            radios.forEach((i) => {
                if (i.checked == true) answer = i.value;
            });
            if (answer == 1) {
                document.getElementById('pecho').style.display = 'block'
                document.getElementById("embarazada_tiempo_bebe").required = true;
            } else if (answer == 2) {
                document.getElementById('pecho').style.display = 'none'
                document.getElementById("embarazada_tiempo_bebe").required = false;

            }
        }


        function toggleAnalytics() {
            var radios = document.getElementsByName("ultima_analitica");
            var answer = '';
            radios.forEach((i) => {
                if (i.checked == true) answer = i.value;
            });
            if (answer == 2) {
                document.getElementById('analytics_section').style.display = 'block'
                document.getElementById("ultima_analitica_txt").required = true;
            } else if (answer == 1) {
                document.getElementById('analytics_section').style.display = 'none'
                document.getElementById("ultima_analitica_txt").required = false;

            }
        }

        function togglePathology() {
            var radios = document.getElementsByName("estado_general");
            var answer = '';
            radios.forEach((i) => {
                if (i.checked == true) answer = i.value;
            });
            if (answer == 2) {
                document.getElementById('patology_general').style.display = 'block'
                document.getElementById("estado_general_txt").required = true;
            } else if (answer == 1) {
                document.getElementById('patology_general').style.display = 'none'
                document.getElementById("estado_general_txt").required = false;

            }
        }
        function toggleDrugs() {
            var radios = document.getElementsByName("medicamento");
            var answer = '';
            radios.forEach((i) => {
                if (i.checked == true) answer = i.value;
            });
            if (answer == 2) {
                document.getElementById('drugs_section').style.display = 'block'
                document.getElementById("medicamento_txt").required = true;
            } else if (answer == 1) {
                document.getElementById('drugs_section').style.display = 'none'
                document.getElementById("medicamento_txt").required = false;

            }
        }
        function toggleSurgy() {
            var radios = document.getElementsByName("quirofano");
            var answer = '';
            radios.forEach((i) => {
                if (i.checked == true) answer = i.value;
            });
            if (answer == 2) {
                document.getElementById('surgy_section').style.display = 'block'
                document.getElementById("quirofano_txt").required = true;
            } else if (answer == 1) {
                document.getElementById('surgy_section').style.display = 'none'
                document.getElementById("quirofano_txt").required = false;

            }
        }
        function toggleExercise() {
            var radios = document.getElementsByName("deporte");
            var answer = '';
            radios.forEach((i) => {
                if (i.checked == true) answer = i.value;
            });
            if (answer == 2) {
                document.getElementById('exercise_section').style.display = 'block'
                document.getElementById("deporte_txt").required = true;
            } else if (answer == 1) {
                document.getElementById('exercise_section').style.display = 'none'
                document.getElementById("deporte_txt").required = false;

            }
        }

        document.getElementById('women_pregnant').style.display = 'none';
        document.getElementById('pregnant_true').style.display = 'none';
        document.getElementById('pecho').style.display = 'none'
        document.getElementById('analytics_section').style.display = 'none'

        document.getElementById('patology_general').style.display = 'none'
        document.getElementById('drugs_section').style.display = 'none'
        document.getElementById('surgy_section').style.display = 'none'
        document.getElementById('exercise_section').style.display = 'none'

        dCounts('ultima_analitica_txt', 20);
        dCounts('peso_adulto_estable', 20);
        dCounts('peso_adulto_minimo', 20);
        dCounts('peso_adulto_maximo', 20);
        dCounts('peso_comodo', 20);
        dCounts('alcohol', 20);
        dCounts('estado_general_txt', 20);
        dCounts('medicamento_txt', 20);
        dCounts('quirofano_txt', 20);
        dCounts('tension', 20);
        dCounts('desayunos_txt', 20);
        dCounts('media_manana_txt', 20);
        dCounts('meriendas_txt', 20);
        dCounts('postre_txt', 20);
        dCounts('postcena_txt', 20);
        dCounts('bebida_en_comidas', 20);
        dCounts('veces_fuera_casa', 20);
        dCounts('leche', 20);
        dCounts('carne_roja', 20);
        dCounts('pescado', 20);
        dCounts('huevos', 20);
        dCounts('verduras', 20);
        dCounts('fruta', 20);
        dCounts('legumbres', 20);
        dCounts('patatas', 20);
        dCounts('pan', 20);
        dCounts('deporte_txt', 20);
        dCounts('intolerancia_txt', 20);
        dCounts('vegetariana_txt', 20);
        dCounts('sin_gracia', 20);
        dCounts('con_gracia', 20);
        dCounts('comentarios', 20);
        dCounts('altura', 3);
        dCounts('peso', 3);
        dCounts('per_m', 2);
        dCounts('per_ci', 2);
        dCounts('per_ca', 2);
        dCounts('telefono', 30);
        dCounts('nif', 30);
        dCounts('email', 30);
        dCounts('nombre', 30);
        dCounts('apellidos', 30);
        dCounts('calle', 30);
        dCounts('numero', 30);
        dCounts('pisoLetra', 30);
        dCounts('cp', 30);
        dCounts('ciudad', 30);
        dCounts('provincia', 30);
    </script>
<?php
    return ob_get_clean();
};
