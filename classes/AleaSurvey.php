<?php

namespace JWR\Alea {

    use PhpOffice\PhpSpreadsheet\Writer\Ods\Content;

    class AleaSurvey
    {
        public static function createSurveyPages()
        {
            Utils::createPage("Alea CRM Start", "comienza", "alea-survey-start", "jwr-alea-crm-survey-start-id", "");
            Utils::createPage("Alea CRM Continue", "continua", "alea-survey-continue", "jwr-alea-crm-survey-continue-id", "");
        }
        public static function deleteSurveyPages()
        {
            Utils::deletePage("jwr-alea-crm-survey-start-id");
            Utils::deletePage("jwr-alea-crm-survey-continue-id");
        }


        public static function startSurveyApply()
        {
        }
        public static function continueSurveyApply()
        {
            global $wp;

            if (isset($_POST['submit']) && $_POST['submit'] == 'Guardar') {
                $data = array(
                    'order'         => (isset($_POST['order'])) ? $_POST['order'] : '',
                    'estricta'      => (isset($_POST['estricta'])) ? $_POST['estricta'] : '',
                    'pesado'        => (isset($_POST['pesado'])) ? $_POST['pesado'] : '',
                    'fuera_casa'    => (isset($_POST['fuera_casa'])) ? $_POST['fuera_casa'] : '',
                    'picoteado'     => (isset($_POST['picoteado'])) ? $_POST['picoteado'] : '',
                    'cocinado'      => (isset($_POST['cocinado'])) ? $_POST['cocinado'] : '',
                    'cambios'       => (isset($_POST['cambios'])) ? $_POST['cambios'] : '',
                    'hambre'        => (isset($_POST['hambre'])) ? $_POST['hambre'] : '',
                    'ansiedad'      => (isset($_POST['ansiedad'])) ? $_POST['ansiedad'] : '',
                    'echas_menos'   => (isset($_POST['echas_menos'])) ? $_POST['echas_menos'] : '',
                    'gustado'       => (isset($_POST['gustado'])) ? $_POST['gustado'] : '',
                    'gustado_txt'   => (isset($_POST['gustado_txt'])) ? $_POST['gustado_txt'] : '',
                    'menores'       => (isset($_POST['menores'])) ? $_POST['menores'] : '',
                    'menores_txt'   => (isset($_POST['menores_txt'])) ? $_POST['menores_txt'] : '',
                    'digestiones'   => (isset($_POST['digestiones'])) ? $_POST['digestiones'] : '',
                    'bano'          => (isset($_POST['bano'])) ? $_POST['bano'] : '',
                    'ejercicio'     => (isset($_POST['ejercicio'])) ? $_POST['ejercicio'] : '',
                    'altura'        => (isset($_POST['altura'])) ? $_POST['altura'] : '',
                    'peso'          => (isset($_POST['peso'])) ? $_POST['peso'] : '',
                    'per_ci'        => (isset($_POST['per_ci'])) ? $_POST['per_ci'] : '',
                    'per_ca'        => (isset($_POST['per_ca'])) ? $_POST['per_ca'] : '',
                    'comentarios'   => (isset($_POST['comentarios'])) ? $_POST['comentarios'] : '',
                    'paciente_nif'  => (isset($_POST['paciente_nif'])) ? $_POST['paciente_nif'] : ''
                );

                $survey = new ContinueSurvey($data);
                $customer = new Customer();
                $customer->getCustomerByNIF($survey->getpaciente_nif());

                $dietData = array(
                    'id' => null,
                    'cliente' => $customer->getId(),
                    'nif' => $customer->getNif(),
                    'tipo' => 2,
                    'fecha' => date("Y-m-d H:i:s"),
                    'parametros' => $survey->toJsonEncode(),
                    'state' => 1,
                    'order' => $survey->getorder(),
                    'enviado' => 0,
                    'opc' => 0,
                    'recordar' => 0,
                    'tipoDieta' => 0,
                    'nuevoModelo' => 1
                );
                $diet = new Dieta($dietData);
                $diet->save();

                echo "<pre>";
                print_r($survey);
                print_r($survey->toArray());
                print_r($survey->toJsonEncode());
                print_r($customer);
                print_r($diet);
                echo "</pre>";
                
                
            } elseif (isset($_POST['submit']) && $_POST['submit'] == 'nif') {

                $customer = new Customer();
                $nif = (isset($_POST['numeric_nif'])) ? $_POST['numeric_nif'] : "";
                $nif .= (isset($_POST['alpha_nif'])) ? $_POST['alpha_nif'] : "";

                if ($nif != '') {
                    $customer->getCustomerByNIF($nif);
                }
                if ($customer->getId() != '') {
                    $survey = new ContinueSurvey();
?>
                    <form action="" method="POST">
                        <?php
                        SELF::customerInfoForm($customer);
                        SELF::continueSurvey($survey);
                        ?>
                        <input type="submit" name="submit" value="Guardar">
                    </form>
                <?php
                } else {
                ?>
                    <h2><a href="<?= home_url('comienza') ?>">¡Inicia ahora!</a></h2>
                <?php
                }
            } else {
                ?>
                <form action="<?= home_url($wp->request); ?>" method="POST">
                    <div class="flex justify-center w-full gb-gray-100 shadow-xl">
                        <label>Ingrese su NIF</label>
                        <input type="text" name="numeric_nif" id="numeric_nif">
                        <input type="text" name="alpha_nif" id="alpha_nif">
                        <input type="submit" name="submit" value="nif">
                    </div>
                </form>
            <?php
            }
        }

        private static function customerInfoForm($customer)
        {
            ?>
            <input type="hidden" name="paciente_nif" value="<?=$customer->getNif();?>">
            <div class="flex flex-wrap w-full bg-gray-100 rounded-xl shadow-xl">
                <a href="<?= home_url() ?>" class="flex justify-center lateral w-2/12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                    </svg>
                    REGRESAR
                </a>
                <div class="lateral w-10/12">

                </div>
                <div class="flex justify-end w-2/12">
                    Paciente:
                </div>
                <div class="w-10/12 justify-star">
                    <div class="flex">
                        <?= $customer->getApellidos(); ?>
                        <?= $customer->getNombre(); ?>
                        <?= $customer->getNif(); ?>
                        <?= $customer->getTelefono(); ?>
                        <?= $customer->getEmail(); ?>
                    </div>
                </div>
            </div>
        <?php
        }

        public static function startSurvey($survey)
        {
        ?>
            <div class="flex justify-center w-full bg-gray-100 shadow-xl">
                Datos de la consulta:
            </div>


            <div class="flex-col flex-wrap bg-red-100 rounded-xl shadow-xl space-y-4">
                <div class="flex"><label>Fecha de nacimiento: </label></div>
                <div class="flex"><input type="text" name="edad" id="edad" value="<?php echo  $survey->getFechaNacimiento() . ' (' . $survey->getedad() . ') años.'; ?>"></div>
                <div class="flex"><label>Sexo: </label></div>
                <div class="flex-row">
                    <fieldset>
                        <label><input type="radio" name="sexo" value="0" <?= ($survey->getsexo() == 0) ? "checked" : ""; ?>>Hombre</label>
                        <label><input type="radio" name="sexo" value="1" <?= ($survey->getsexo() == 1) ? "checked" : ""; ?>>Mujer</label>
                    </fieldset>
                </div>
                <div class="flex"><label>Altura (cm): </label></div>
                <div class="flex"><input type="text" name="altura" id="altura" value="<?= $survey->getaltura(); ?>"></div>
                <div class="flex"><label>Peso (Kg): </label></div>
                <div class="flex"><input type="text" name="peso" id="peso" value="<?= $survey->getpeso(); ?>"></div>
                <div class="flex"><label>Perímetro de muñeca (cm): </label></div>
                <div class="flex"><input type="text" name="per_m" id="per_m" value="<?= $survey->getper_m(); ?>"></div>
                <div class="flex"><label>Perímetro de cintura (cm): </label></div>
                <div class="flex"><input type="text" name="per_ci" id="per_ci" value="<?= $survey->getper_ci(); ?>"></div>
                <div class="flex"><label>Perímetro de cadera (cm): </label></div>
                <div class="flex"><input type="text" name="per_ca" id="per_ca" value="<?= $survey->getper_ca(); ?>"></div>
                <div class="flex"><label>Durante tu infancia y adolescencia tu peso era : </label></div>
                <div class="flex-row">
                    <fieldset>
                        <label><input type="radio" name="peso_infancia" value="1" <?= ($survey->getpeso_infancia() == 1) ? "checked" : ""; ?>>Adecuado</label>
                        <label><input type="radio" name="peso_infancia" value="2" <?= ($survey->getpeso_infancia() == 2) ? "checked" : ""; ?>>Alto o muy alto</label>
                        <label><input type="radio" name="peso_infancia" value="3" <?= ($survey->getpeso_infancia() == 3) ? "checked" : ""; ?>>Bajo o muy bajo</label>
                    </fieldset>
                </div>
                <div class="flex"><label>Ya en la edad adulta, tu peso más estable ha sido : </label></div>
                <div class="flex"><input type="text" name="peso_adulto_estable" id="peso_adulto_estable" value="<?= $survey->getpeso_adulto_estable(); ?>"></div>
                <div class="flex"><label>Tu peso mínimo (edad adulta) ha sido: </label></div>
                <div class="flex"><input type="text" name="peso_adulto_minimo" id="peso_adulto_minimo" value="<?= $survey->getpeso_adulto_minimo(); ?>"></div>
                <div class="flex"><label>Tu peso máximo (edad adulta) ha sido: </label></div>
                <div class="flex"><input type="text" name="peso_adulto_maximo" id="peso_adulto_maximo" value="<?= $survey->getpeso_adulto_maximo(); ?>"></div>
                <div class="flex"><label>En el último año tu peso: </label></div>
                <div class="flex-row">
                    <fieldset>
                        <label><input type="radio" name="peso_ultimo" value="1" <?= ($survey->getpeso_ultimo() == 1) ? "checked" : ""; ?>>Ha aumetado</label>
                        <label><input type="radio" name="peso_ultimo" value="2" <?= ($survey->getpeso_ultimo() == 2) ? "checked" : ""; ?>>Se ha mantenido</label>
                        <label><input type="radio" name="peso_ultimo" value="3" <?= ($survey->getpeso_ultimo() == 3) ? "checked" : ""; ?>>Ha disminuído</label>
                    </fieldset>
                </div>
                <div class="flex"><label>¿Ha hecho dieta de adelgazamiento en el último año?: </label></div>
                <div class="flex-row">
                    <fieldset>
                        <label><input type="radio" name="dieta_ultimo" value="1" <?= ($survey->getdieta_ultimo() == 1) ? "checked" : ""; ?>>Si</label>
                        <label><input type="radio" name="dieta_ultimo" value="2" <?= ($survey->getdieta_ultimo() == 2) ? "checked" : ""; ?>>No</label>
                    </fieldset>
                </div>
                <div class="flex"><label>¿Haz estado embarazada?: </label></div>
                <div class="flex-row">
                    <fieldset>
                        <label><input type="radio" name="embarazada" value="1" <?= ($survey->getembarazada() == 1) ? "checked" : ""; ?>>Si</label>
                        <label><input type="radio" name="embarazada" value="2" <?= ($survey->getembarazada() == 2) ? "checked" : ""; ?>>No</label>
                    </fieldset>
                </div>
                <div class="flex"><label>embarazada_tiempo_bebe: </label></div>
                <div class="flex"><input type="text" name="embarazada_tiempo_bebe" id="embarazada_tiempo_bebe" value="<?= $survey->getembarazada_tiempo_bebe(); ?>"></div>
                <div class="flex"><label>Según tu, ¿Cuál es la principal causa de tus kilos de más?: </label></div>
                <div class="flex-row">
                    <fieldset>
                        <label><input type="radio" name="causa_kilos" value="1" <?= ($survey->getcausa_kilos() == 1) ? "checked" : ""; ?>>Alimentación muy desordenada</label>
                        <label><input type="radio" name="causa_kilos" value="2" <?= ($survey->getcausa_kilos() == 2) ? "checked" : ""; ?>>Picoteos entre horas</label>
                        <label><input type="radio" name="causa_kilos" value="3" <?= ($survey->getcausa_kilos() == 3) ? "checked" : ""; ?>>Comidas o cenas muy abundantes</label>
                        <label><input type="radio" name="causa_kilos" value="4" <?= ($survey->getcausa_kilos() == 4) ? "checked" : ""; ?>>No lo sé</label>
                    </fieldset>
                </div>
                <div class="flex"><label>¿En qué peso crees tu que estarías más cómodo?: </label></div>
                <div class="flex"><input type="text" name="peso_comodo" id="peso_comodo" value="<?= $survey->getpeso_comodo(); ?>"></div>
                <div class="flex"><label>En tu última analítica ¿Tenías algo fuera de orden?: </label></div>
                <div class="flex-row">
                    <fieldset>
                        <label><input type="radio" name="ultima_analitica" value="1" <?= ($survey->getultima_analitica() == 1) ? "checked" : ""; ?>>Si</label>
                        <label><input type="radio" name="ultima_analitica" value="2" <?= ($survey->getultima_analitica() == 2) ? "checked" : ""; ?>>No</label>
                    </fieldset>
                </div>
                <div class="flex"><label>Explícate: </label></div>
                <div class="flex"><input type="text" name="ultima_analitica_txt" id="ultima_analitica_txt" value="<?= $survey->getultima_analitica_txt(); ?>"></div>
                <div class="flex"><label>Hablando de tu estado general de salud, ¿tienes alguna patología?: </label></div>
                <div class="flex-row">
                    <fieldset>
                        <label><input type="radio" name="estado_general" value="1" <?= ($survey->getestado_general() == 1) ? "checked" : ""; ?>>Si</label>
                        <label><input type="radio" name="estado_general" value="2" <?= ($survey->getestado_general() == 2) ? "checked" : ""; ?>>No</label>
                    </fieldset>
                </div>
                <div class="flex"><label>Explícate: </label></div>
                <div class="flex"><input type="text" name="estado_general_txt" id="estado_general_txt" value="<?= $survey->getestado_general_txt(); ?>"></div>
                <div class="flex"><label>¿Estás tomando algún medicamento de forma habitual?: </label></div>
                <div class="flex-row">
                    <fieldset>
                        <label><input type="radio" name="medicamento" value="1" <?= ($survey->getmedicamento() == 1) ? "checked" : ""; ?>>Si</label>
                        <label><input type="radio" name="medicamento" value="2" <?= ($survey->getmedicamento() == 2) ? "checked" : ""; ?>>No</label>
                    </fieldset>
                </div>
                <div class="flex"><label>Cuéntanos: </label></div>
                <div class="flex"><input type="text" name="medicamento_txt" id="medicamento_txt" value="<?= $survey->getmedicamento_txt(); ?>"></div>
                <div class="flex"><label>¿Has pasado por el quirófano alguna vez?: </label></div>
                <div class="flex-row">
                    <fieldset>
                        <label><input type="radio" name="quirofano" value="1" <?= ($survey->getquirofano() == 1) ? "checked" : ""; ?>>Si</label>
                        <label><input type="radio" name="quirofano" value="2" <?= ($survey->getquirofano() == 2) ? "checked" : ""; ?>>No</label>
                    </fieldset>
                </div>
                <div class="flex"><label>Explícate: </label></div>
                <div class="flex"><input type="text" name="quirofano_txt" id="quirofano_txt" value="<?= $survey->getquirofano_txt(); ?>"></div>
                <div class="flex"><label>¿Cómo son tus reglas?: </label></div>
                <div class="flex-row">
                    <fieldset>
                        <label><input type="radio" name="reglas" value="1" <?= ($survey->getreglas() == 1) ? "checked" : ""; ?>>Regulares</label>
                        <label><input type="radio" name="reglas" value="2" <?= ($survey->getreglas() == 2) ? "checked" : ""; ?>>Irregulares</label>
                        <label><input type="radio" name="reglas" value="3" <?= ($survey->getreglas() == 3) ? "checked" : ""; ?>>Ya no tengo la regla</label>
                    </fieldset>
                </div>
                <div class="flex"><label>Tu tensión arterial es: </label></div>
                <div class="flex"><input type="text" name="tension" id="tension" value="<?= $survey->gettension(); ?>"></div>
                <div class="flex"><label>¿Cómo son tus digestiones?: </label></div>
                <div class="flex-row">
                    <fieldset>
                        <label><input type="radio" name="digestiones" value="1" <?= ($survey->getdigestiones() == 1) ? "checked" : ""; ?>>Buenas</label>
                        <label><input type="radio" name="digestiones" value="2" <?= ($survey->getdigestiones() == 2) ? "checked" : ""; ?>>Tengo ardores</label>
                        <label><input type="radio" name="digestiones" value="3" <?= ($survey->getdigestiones() == 3) ? "checked" : ""; ?>>Tengo reflujo</label>
                        <label><input type="radio" name="digestiones" value="4" <?= ($survey->getdigestiones() == 4) ? "checked" : ""; ?>>Muy lentas</label>
                    </fieldset>
                </div>
                <div class="flex"><label>¿Cómo vas al baño?: </label></div>
                <div class="flex-row">
                    <fieldset>
                        <label><input type="radio" name="bano" value="1" <?= ($survey->getbano() == 1) ? "checked" : ""; ?>>Regularmente</label>
                        <label><input type="radio" name="bano" value="2" <?= ($survey->getbano() == 2) ? "checked" : ""; ?>>Sufro cierto estreñimiento si no me cuido</label>
                        <label><input type="radio" name="bano" value="3" <?= ($survey->getbano() == 3) ? "checked" : ""; ?>>Sufro estreñimiento habitualmente</label>
                    </fieldset>
                </div>
                <div class="flex"><label>¿Cuánto alcohol tomas a la semana?: </label></div>
                <div class="flex"><input type="text" name="alcohol" id="alcohol" value="<?= $survey->getalcohol(); ?>"></div>
                <div class="flex"><label>¿Fumas?: </label></div>
                <div class="flex-row">
                    <fieldset>
                        <label><input type="radio" name="tabaco" value="1" <?= ($survey->gettabaco() == 1) ? "checked" : ""; ?>>No</label>
                        <label><input type="radio" name="tabaco" value="2" <?= ($survey->gettabaco() == 2) ? "checked" : ""; ?>>Menos de 10 cigarrillos al día</label>
                        <label><input type="radio" name="tabaco" value="3" <?= ($survey->gettabaco() == 3) ? "checked" : ""; ?>>Más de 10 cigarrillos al día</label>
                    </fieldset>
                </div>
                <div class="flex"><label>Según tú, tu rutina diaria es: </label></div>
                <div class="flex-row">
                    <fieldset>
                        <label><input type="radio" name="rutina" value="1" <?= ($survey->getrutina() == 1) ? "checked" : ""; ?>>Activa o muy activa</label>
                        <label><input type="radio" name="rutina" value="2" <?= ($survey->getrutina() == 2) ? "checked" : ""; ?>>Más bien sedentaria</label>
                    </fieldset>
                </div>
                <div class="flex"><label>¿Cuántas horas pasas en la cama, estés o no durmiendo?: </label></div>
                <div class="flex-row">
                    <fieldset>
                        <label><input type="radio" name="cama" value="1" <?= ($survey->getcama() == 1) ? "checked" : ""; ?>>Menos de 6 horas</label>
                        <label><input type="radio" name="cama" value="2" <?= ($survey->getcama() == 2) ? "checked" : ""; ?>>Entre 6 y 8 horas</label>
                        <label><input type="radio" name="cama" value="3" <?= ($survey->getcama() == 3) ? "checked" : ""; ?>>Entre 8 y 10 horas</label>
                        <label><input type="radio" name="cama" value="4" <?= ($survey->getcama() == 4) ? "checked" : ""; ?>>Más de 10 horas</label>
                    </fieldset>
                </div>
                <div class="flex"><label>¿Cuánto caminas cada día?: </label></div>
                <div class="flex-row">
                    <fieldset>
                        <label><input type="radio" name="caminar" value="1" <?= ($survey->getcaminar() == 1) ? "checked" : ""; ?>>Entre media y una hora</label>
                        <label><input type="radio" name="caminar" value="2" <?= ($survey->getcaminar() == 2) ? "checked" : ""; ?>>Entre una y dos horas</label>
                        <label><input type="radio" name="caminar" value="3" <?= ($survey->getcaminar() == 3) ? "checked" : ""; ?>>Más de dos horas</label>
                    </fieldset>
                </div>
                <div class="flex"><label>¿Haces deporte regularmente?: </label></div>
                <div class="flex-row">
                    <fieldset>
                        <label><input type="radio" name="deporte" value="1" <?= ($survey->getdeporte() == 1) ? "checked" : ""; ?>>Si</label>
                        <label><input type="radio" name="deporte" value="2" <?= ($survey->getdeporte() == 2) ? "checked" : ""; ?>>No</label>
                    </fieldset>
                </div>
                <div class="flex"><label>Cuéntanos qué haces, cuánto tiempo y cuántas veces a la semana: </label></div>
                <div class="flex"><input type="text" name="deporte_txt" id="deporte_txt" value="<?= $survey->getdeporte_txt(); ?>"></div>
                <div class="flex"><label>¿Qué desayunas?: </label></div>
                <div class="flex"><input type="text" name="desayunos_txt" id="desayunos_txt" value="<?= $survey->getdesayunos_txt(); ?>"></div>
                <div class="flex"><label>¿Qué tomas a media mañana?: </label></div>
                <div class="flex"><input type="text" name="media_manana_txt" id="media_manana_txt" value="<?= $survey->getmedia_manana_txt(); ?>"></div>
                <div class="flex"><label>¿Qué meriendas?: </label></div>
                <div class="flex"><input type="text" name="meriendas_txt" id="meriendas_txt" value="<?= $survey->getmeriendas_txt(); ?>"></div>
                <div class="flex"><label>¿Tomas algo de postre tras comer y cenar?: </label></div>
                <div class="flex"><input type="text" name="postre_txt" id="postre_txt" value="<?= $survey->getpostre_txt(); ?>"></div>
                <div class="flex"><label>¿Comes algo desde que cenas hasta que te vas a la cama, más allá del postre?: </label></div>
                <div class="flex"><input type="text" name="postcena_txt" id="postcena_txt" value="<?= $survey->getpostcena_txt(); ?>"></div>
                <div class="flex"><label>¿Qué bebes durante la comida y la cena?: </label></div>
                <div class="flex"><input type="text" name="bebida_en_comidas" id="bebida_en_comidas" value="<?= $survey->getbebida_en_comidas(); ?>"></div>
                <div class="flex"><label>¿Cuántas veces a la semana comes, cenas o tapeas fuera de casa?: </label></div>
                <div class="flex"><input type="text" name="veces_fuera_casa" id="veces_fuera_casa" value="<?= $survey->getveces_fuera_casa(); ?>"></div>
                <div class="flex"><label>¿Comes o cenas fuera de casa por trabajo?: </label></div>
                <div class="flex-row">
                    <fieldset>
                        <label><input type="radio" name="fuera_casa_trabajo" value="1" <?= ($survey->getfuera_casa_trabajo() == 1) ? "checked" : ""; ?>>Nunca o casi nunca</label>
                        <label><input type="radio" name="fuera_casa_trabajo" value="2" <?= ($survey->getfuera_casa_trabajo() == 2) ? "checked" : ""; ?>>Una o dos veces al mes</label>
                        <label><input type="radio" name="fuera_casa_trabajo" value="3" <?= ($survey->getfuera_casa_trabajo() == 3) ? "checked" : ""; ?>>Varias veces a la semana</label>
                    </fieldset>
                </div>
                <div class="flex"><label>Picoteas entre horas: </label></div>
                <div class="flex-row">
                    <fieldset>
                        <label><input type="radio" name="picoteas" value="1" <?= ($survey->getpicoteas() == 1) ? "checked" : ""; ?>>No, nunca</label>
                        <label><input type="radio" name="picoteas" value="2" <?= ($survey->getpicoteas() == 2) ? "checked" : ""; ?>>Sí, muy habitualmente, en casa o en el trabajo</label>
                        <label><input type="radio" name="picoteas" value="3" <?= ($survey->getpicoteas() == 3) ? "checked" : ""; ?>>A veces, según temporadas</label>
                    </fieldset>
                </div>
                <div class="flex"><label>¿En qué momento del día tienes más ansiedad por la comida?: </label></div>
                <div class="flex-row">
                    <fieldset>
                        <label><input type="radio" name="ansiedad_comida" value="1" <?= ($survey->getansiedad_comida() == 1) ? "checked" : ""; ?>>Nunca tengo ansiedad por la comida</label>
                        <label><input type="radio" name="ansiedad_comida" value="2" <?= ($survey->getansiedad_comida() == 2) ? "checked" : ""; ?>>Por la mañana</label>
                        <label><input type="radio" name="ansiedad_comida" value="3" <?= ($survey->getansiedad_comida() == 3) ? "checked" : ""; ?>>Por la tarde</label>
                        <label><input type="radio" name="ansiedad_comida" value="4" <?= ($survey->getansiedad_comida() == 4) ? "checked" : ""; ?>>Después de cenar</label>
                    </fieldset>
                </div>
                <div class="flex"><label>¿Cuántos lácteos tomas al día? (Si son bebidas vegetales, indícanoslo): </label></div>
                <div class="flex"><input type="text" name="leche" id="leche" value="<?= $survey->getleche(); ?>"></div>
                <div class="flex"><label>¿Cuántas veces tomas carne a la semana?: </label></div>
                <div class="flex"><input type="text" name="carne_roja" id="carne_roja" value="<?= $survey->getcarne_roja(); ?>"></div>
                <div class="flex"><label>¿Cuántas veces tomas pescado a la semana?: </label></div>
                <div class="flex"><input type="text" name="pescado" id="pescado" value="<?= $survey->getpescado(); ?>"></div>
                <div class="flex"><label>¿Cuántos huevos tomas a la semana?: </label></div>
                <div class="flex"><input type="text" name="huevos" id="huevos" value="<?= $survey->gethuevos(); ?>"></div>
                <div class="flex"><label>¿Tomas verduras y hortalizas a diario?: </label></div>
                <div class="flex"><input type="text" name="verduras" id="verduras" value="<?= $survey->getverduras(); ?>"></div>
                <div class="flex"><label>¿Cuántas piezas de fruta tomas al día?: </label></div>
                <div class="flex"><input type="text" name="fruta" id="fruta" value="<?= $survey->getfruta(); ?>"></div>
                <div class="flex"><label>¿Cuántas veces a la semana tomas legumbres?: </label></div>
                <div class="flex"><input type="text" name="legumbres" id="legumbres" value="<?= $survey->getlegumbres(); ?>"></div>
                <div class="flex"><label>¿Cuántas veces a la semana consumes patatas, pasta, arroz, quinoa, espelta…?: </label></div>
                <div class="flex"><input type="text" name="patatas" id="patatas" value="<?= $survey->getpatatas(); ?>"></div>
                <div class="flex"><label>Estima cuánto pan tomas al día (por ejemplo: medio colón, un cuarto de barra…): </label></div>
                <div class="flex"><input type="text" name="pan" id="pan" value="<?= $survey->getpan(); ?>"></div>
                <div class="flex"><label>Comida rápida: </label></div>
                <div class="flex-row">
                    <fieldset>
                        <label><input type="radio" name="comida_rapida" value="1" <?= ($survey->getcomida_rapida() == 1) ? "checked" : ""; ?>>Nunca</label>
                        <label><input type="radio" name="comida_rapida" value="2" <?= ($survey->getcomida_rapida() == 2) ? "checked" : ""; ?>>1 o 2 veces por semana</label>
                        <label><input type="radio" name="comida_rapida" value="3" <?= ($survey->getcomida_rapida() == 3) ? "checked" : ""; ?>>3 veces o más por semana</label>
                    </fieldset>
                </div>
                <div class="flex"><label>Comida precocinada: </label></div>
                <div class="flex-row">
                    <fieldset>
                        <label><input type="radio" name="precocinada" value="1" <?= ($survey->getprecocinada() == 1) ? "checked" : ""; ?>>Nunca</label>
                        <label><input type="radio" name="precocinada" value="2" <?= ($survey->getprecocinada() == 2) ? "checked" : ""; ?>>1 o 2 veces por semana</label>
                        <label><input type="radio" name="precocinada" value="3" <?= ($survey->getprecocinada() == 3) ? "checked" : ""; ?>>3 veces o más por semana</label>
                    </fieldset>
                </div>
                <div class="flex"><label>Snacks: </label></div>
                <div class="flex-row">
                    <fieldset>
                        <label><input type="radio" name="snacks" value="1" <?= ($survey->getsnacks() == 1) ? "checked" : ""; ?>>Nunca</label>
                        <label><input type="radio" name="snacks" value="2" <?= ($survey->getsnacks() == 2) ? "checked" : ""; ?>>1 o 2 veces por semana</label>
                        <label><input type="radio" name="snacks" value="3" <?= ($survey->getsnacks() == 3) ? "checked" : ""; ?>>3 veces o más por semana</label>
                    </fieldset>
                </div>
                <div class="flex"><label>Bollería, dulces: </label></div>
                <div class="flex-row">
                    <fieldset>
                        <label><input type="radio" name="bolleria" value="1" <?= ($survey->getbolleria() == 1) ? "checked" : ""; ?>>Nunca</label>
                        <label><input type="radio" name="bolleria" value="2" <?= ($survey->getbolleria() == 2) ? "checked" : ""; ?>>1 o 2 veces por semana</label>
                        <label><input type="radio" name="bolleria" value="3" <?= ($survey->getbolleria() == 3) ? "checked" : ""; ?>>3 veces o más por semana</label>
                    </fieldset>
                </div>
                <div class="flex"><label>¿Te han diagnosticado intolerancia o alergia a algún alimento?: </label></div>
                <div class="flex"><input type="text" name="intolerancia_txt" id="intolerancia_txt" value="<?= $survey->getintolerancia_txt(); ?>"></div>
                <div class="flex"><label>¿Sigues dieta ovolactovegetariana o vegana?: </label></div>
                <div class="flex"><input type="text" name="vegetariana_txt" id="vegetariana_txt" value="<?= $survey->getvegetariana_txt(); ?>"></div>
                <div class="flex"><label>Indícanos alimentos que no te hacen mucha gracia: </label></div>
                <div class="flex"><input type="text" name="sin_gracia" id="sin_gracia" value="<?= $survey->getsin_gracia(); ?>"></div>
                <div class="flex"><label>Ahora dinos qué alimentos o platos te encantan: </label></div>
                <div class="flex"><input type="text" name="con_gracia" id="con_gracia" value="<?= $survey->getcon_gracia(); ?>"></div>
                <div class="flex"><label>¿Te llevas la comida al trabajo?: </label></div>
                <div class="flex-row">
                    <fieldset>
                        <label><input type="radio" name="trabajo" value="1" <?= ($survey->gettrabajo() == 1) ? "checked" : ""; ?>>Nunca o casi nunca</label>
                        <label><input type="radio" name="trabajo" value="2" <?= ($survey->gettrabajo() == 2) ? "checked" : ""; ?>>Siempre</label>
                        <label><input type="radio" name="trabajo" value="3" <?= ($survey->gettrabajo() == 3) ? "checked" : ""; ?>>Varias veces a la semana</label>
                    </fieldset>
                </div>
                <div class="flex"><label>¿Prefieres tener un primer plato y un segundo, o un plato único que aúne todo?: </label></div>
                <div class="flex-row">
                    <fieldset>
                        <label><input type="radio" name="unico" value="1" <?= ($survey->getunico() == 1) ? "checked" : ""; ?>>Primero y segundo</label>
                        <label><input type="radio" name="unico" value="2" <?= ($survey->getunico() == 2) ? "checked" : ""; ?>>Plato único</label>
                        <label><input type="radio" name="unico" value="3" <?= ($survey->getunico() == 3) ? "checked" : ""; ?>>Me da igual</label>
                    </fieldset>
                </div>
                <div class="flex"><label>¿Se nos olvida preguntarte algo? ¿Hay algo que nos quieras comentar o puntualizar? ¡Ahora es el momento!: </label></div>
                <div class="flex"><input type="text" name="comentarios" id="comentarios" value="<?= $survey->getcomentarios(); ?>"></div>
                <div class="flex"><label>Newsletter: </label></div>
                <div class="flex"><input type="text" name="newsletter" id="newsletter" value="<?= $survey->getnewsletter(); ?>"></div>
            </div>

        <?php
        }
        public static function continueSurvey($survey)
        {
        ?>
            <div class="flex-col flex-wrap bg-red-100 rounded-xl shadow-xl space-y-4">
                <div class="flex"><label>¿Has hecho la dieta de forma estricta, a tu parecer?: </label></div>
                <div class="flex-row">
                    <input type="radio" name="estricta" value="1" <?= ($survey->getestricta() == 1) ? "checked" : ""; ?>><label>En general, sí</label>
                    <input type="radio" name="estricta" value="2" <?= ($survey->getestricta() == 2) ? "checked" : ""; ?>><label>En general, no</label>
                    <input type="radio" name="estricta" value="3" <?= ($survey->getestricta() == 3) ? "checked" : ""; ?>><label>Más o menos</label>
                </div>
                <div class="flex"><label>¿Has pesado los alimentos? (Recuerda que hay que hacerlo con báscula digital): </label></div>
                <div class="flex-row">
                    <input type="radio" name="pesado" value="1" <?= ($survey->getpesado() == 1) ? "checked" : ""; ?>><label>Si, siempre</label>
                    <input type="radio" name="pesado" value="2" <?= ($survey->getpesado() == 2) ? "checked" : ""; ?>><label>No siempre</label>
                </div>
                <div class="flex"><label>¿Has tenido comidas o cenas fuera de casa (restaurante, comida rápida, tapeo)?: </label></div>
                <div class="flex-row">
                    <input type="radio" name="fuera_casa" value="1" <?= ($survey->getfuera_casa() == 1) ? "checked" : ""; ?>><label>Ninguna vez</label>
                    <input type="radio" name="fuera_casa" value="2" <?= ($survey->getfuera_casa() == 2) ? "checked" : ""; ?>><label>1-2 veces</label>
                    <input type="radio" name="fuera_casa" value="3" <?= ($survey->getfuera_casa() == 3) ? "checked" : ""; ?>><label>3 veces o más</label>
                </div>
                <div class="flex"><label>¿Has picoteado entre horas fuera o dentro de casa?: </label></div>
                <div class="flex-row">
                    <input type="radio" name="picoteado" value="1" <?= ($survey->getpicoteado() == 1) ? "checked" : ""; ?>><label>Ninguna vez</label>
                    <input type="radio" name="picoteado" value="2" <?= ($survey->getpicoteado() == 2) ? "checked" : ""; ?>><label>1-2 veces</label>
                    <input type="radio" name="picoteado" value="3" <?= ($survey->getpicoteado() == 3) ? "checked" : ""; ?>><label>3 veces o más</label>
                </div>
                <div class="flex"><label>Estando en casa, ¿has cocinado cada día lo que te correspondía en la dieta?: </label></div>
                <div class="flex-row">
                    <input type="radio" name="cocinado" value="1" <?= ($survey->getcocinado() == 1) ? "checked" : ""; ?>><label>Sí, siempre</label>
                    <input type="radio" name="cocinado" value="2" <?= ($survey->getcocinado() == 2) ? "checked" : ""; ?>><label>No siempre</label>
                </div>
                <div class="flex"><label>¿Has hecho muchos cambios en la dieta que te planteamos?: </label></div>
                <div class="flex-row">
                    <input type="radio" name="cambios" value="1" <?= ($survey->getcambios() == 1) ? "checked" : ""; ?>><label>Ninguna vez</label>
                    <input type="radio" name="cambios" value="2" <?= ($survey->getcambios() == 2) ? "checked" : ""; ?>><label>1-2 veces</label>
                    <input type="radio" name="cambios" value="3" <?= ($survey->getcambios() == 3) ? "checked" : ""; ?>><label>3 veces o más</label>
                </div>
                <div class="flex"><label>¿Has pasado hambre?: </label></div>
                <div class="flex-row">
                    <input type="radio" name="hambre" value="1" <?= ($survey->gethambre() == 1) ? "checked" : ""; ?>><label>En general, sí</label>
                    <input type="radio" name="hambre" value="2" <?= ($survey->gethambre() == 2) ? "checked" : ""; ?>><label>En general, no</label>
                </div>
                <div class="flex"><label>¿Has tenido ansiedad en algún momento del día?: </label></div>
                <div class="flex-row">
                    <input type="radio" name="ansiedad" value="1" <?= ($survey->getansiedad() == 1) ? "checked" : ""; ?>><label>Por norma general no</label>
                    <input type="radio" name="ansiedad" value="2" <?= ($survey->getansiedad() == 2) ? "checked" : ""; ?>><label>Algún día</label>
                    <input type="radio" name="ansiedad" value="3" <?= ($survey->getansiedad() == 3) ? "checked" : ""; ?>><label>Muchos días</label>
                </div>
                <div class="flex"><label>¿Echas de menos algún ingrediente o plato en concreto?: </label></div>
                <div class="flex"><input type="text" name="echas_menos" id="echas_menos" value="<?= $survey->getechas_menos(); ?>"></div>
                <div class="flex"><label>¿Te han gustado en general las recetas de la dieta anterior?: </label></div>
                <div class="flex-row">
                    <input type="radio" name="gustado" value="1" <?= ($survey->getgustado() == 1) ? "checked" : ""; ?>><label>En general, sí</label>
                    <input type="radio" name="gustado" value="2" <?= ($survey->getgustado() == 2) ? "checked" : ""; ?>><label>En general, no</label>
                </div>
                <div class="flex"><label>¿Qué no te ha gustado?: </label></div>
                <div class="flex"><input type="text" name="gustado_txt" id="gustado_txt" value="<?= $survey->getgustado_txt(); ?>"></div>
                <div class="flex"><label>¿Estás a gusto con las comidas menores (desayuno, media mañana y merienda)?: </label></div>
                <div class="flex-row">
                    <input type="radio" name="menores" value="1" <?= ($survey->getmenores() == 1) ? "checked" : ""; ?>><label>Sí</label>
                    <input type="radio" name="menores" value="2" <?= ($survey->getmenores() == 2) ? "checked" : ""; ?>><label>No</label>
                </div>
                <div class="flex"><label>¿Qué no te ha gustado?: </label></div>
                <div class="flex"><input type="text" name="menores_txt" id="menores_txt" value="<?= $survey->getmenores_txt(); ?>"></div>
                <div class="flex"><label>¿Qué tal tus digestiones?: </label></div>
                <div class="flex-row">
                    <input type="radio" name="digestiones" value="1" <?= ($survey->getdigestiones() == 1) ? "checked" : ""; ?>><label>Buenas</label>
                    <input type="radio" name="digestiones" value="2" <?= ($survey->getdigestiones() == 2) ? "checked" : ""; ?>><label>Malas</label>
                </div>
                <div class="flex"><label>¿Qué tal has ido al baño?: </label></div>
                <div class="flex-row">
                    <input type="radio" name="bano" value="1" <?= ($survey->getbano() == 1) ? "checked" : ""; ?>><label>Bien</label>
                    <input type="radio" name="bano" value="2" <?= ($survey->getbano() == 2) ? "checked" : ""; ?>><label>Más o menos</label>
                    <input type="radio" name="bano" value="3" <?= ($survey->getbano() == 3) ? "checked" : ""; ?>><label>Mal</label>
                </div>
                <div class="flex"><label>¿Has hecho ejercicio?: </label></div>
                <div class="flex-row">
                    <input type="radio" name="ejercicio" value="1" <?= ($survey->getejercicio() == 1) ? "checked" : ""; ?>><label>Ninguna vez</label>
                    <input type="radio" name="ejercicio" value="2" <?= ($survey->getejercicio() == 2) ? "checked" : ""; ?>><label>1-2 veces por semana</label>
                    <input type="radio" name="ejercicio" value="3" <?= ($survey->getejercicio() == 3) ? "checked" : ""; ?>><label>3 veces o más por semana</label>
                </div>
                <div class="flex"><label>Altura (cm): </label></div>
                <div class="flex"><input type="text" name="altura" id="altura" value="<?= $survey->getaltura(); ?>"></div>
                <div class="flex"><label>Peso (kg): </label></div>
                <div class="flex"><input type="text" name="peso" id="peso" value="<?= $survey->getpeso(); ?>"></div>
                <div class="flex"><label>Perímetro de cintura (cm): </label></div>
                <div class="flex"><input type="text" name="per_ci" id="per_ci" value="<?= $survey->getper_ci(); ?>"></div>
                <div class="flex"><label>Perímetro de cadera (cm): </label></div>
                <div class="flex"><input type="text" name="per_ca" id="per_ca" value="<?= $survey->getper_ca(); ?>"></div>
                <div class="flex"><label>comentarios: </label></div>
                <div class="flex"><input type="text" name="comentarios" id="comentarios" value="<?= $survey->getcomentarios(); ?>"></div>
            </div>



<?php
        }
    } // EOC
} // namespace
