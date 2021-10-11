<?php

namespace JWR\Alea {

    // require_once(WP_PLUGIN_DIR."/jwr-alea-crm/model/ContinueSurvey.php");
    // require_once(WP_PLUGIN_DIR."/jwr-alea-crm/model/StartSurvey.php");

    class AleaCRMSurvey
    {
        public static function createSurveyPages()
        {
            Utils::createPage("Alea CRM Start", "comienza", "alea-survey-start", "jwr-alea-crm-survey-start-id", "");
            Utils::createPage("Alea CRM Continue", "continua", "alea-survey-continue", "jwr-alea-crm-survey-continue-id", "");
            Utils::createPage("Alea CRM Payment", "registrado", "alea-survey-register", "jwr-alea-crm-survey-register-id", "");
        }
        public static function deleteSurveyPages()
        {
            Utils::deletePage("jwr-alea-crm-survey-start-id");
            Utils::deletePage("jwr-alea-crm-survey-continue-id");
            Utils::deletePage("jwr-alea-crm-survey-register-id");
        }


        public static function registerSurveyApply()
        {
            $payment = new AleaCRMPayment();
            $response = $payment->get_response();

            $descripcion = (isset($response['decodec']['Ds_MerchantData'])) ? json_decode(urldecode($response['decodec']['Ds_MerchantData']), true)['description'] : "Dieta";

            if ($response['OK']) {

                $customerArray = json_decode($_SESSION['customer'], true);
                $surveyArray = json_decode($_SESSION['survey'], true);

                $customer = new  Customer($customerArray);
                $customer->save();

                $tipo = $_SESSION['tipo'];

                if ($tipo == 1) {
                    $survey = new  StartSurvey($surveyArray);
                } else if ($tipo == 2) {
                    $survey = new  ContinueSurvey($surveyArray);
                } else {
                    wp_die("No sabemo cómos llegaste aquí, pero ¡regresa por donde haz venido!");
                }

                $customer->setId($customer->save());
                $dietData = array(
                    'id' => null,
                    'cliente' => $customer->getId(),
                    'nif' => $customer->getNif(),
                    'tipo' => $tipo,
                    'fecha' => date("Y-m-d H:i:s"),
                    'parametros' => $survey->toJsonEncode(),
                    'state' => 0,
                    'order' => $survey->getorder(),
                    'enviado' => 0,
                    'opc' => 0,
                    'recordar' => 0,
                    'tipoDieta' => 0,
                    'nuevoModelo' => 1
                );
                $diet = new Dieta($dietData);
                $diet->save();

                $invoice = new Factura;
                $invoiceData = array(
                    'referencia' => $invoice->getLastInvoiceNumber(1),
                    'fecha' => date("Y-m-d H:i:s"),
                    'cliente' => $customer->getId(),
                    'dietaid' => $diet->getId(),
                    'nombre' => $customer->getNombre(),
                    'apellidos' => $customer->getApellidos(),
                    'nif' => $customer->getNif(),
                    'calle' => $customer->getCalle(),
                    'numero' => $customer->getNumero(),
                    'pisoLetra' => $customer->getPisoLetra(),
                    'cp' => $customer->getCp(),
                    'ciudad' => $customer->getCiudad(),
                    'provincia' => $customer->getProvincia(),
                    'concepto' => $descripcion,
                    'precio' => $response['decodec']['Ds_Amount'] / 100,
                    'iva' => 0,
                    'total' => $response['decodec']['Ds_Amount'] / 100,
                    'state' => 1 // online
                );
                $invoice = new Factura($invoiceData);
                $invoice->save();
                $invoice->mailInvoice($customer->getEmail());


                SELF::graciasForm();

                echo '<a href="' . home_url('online-invoices') . '">Clic</a>';
            }
        }
        public static function startSurveyApply()
        {
            $_SESSION['tipo'] = "1";
            if (isset($_POST['submit']) && $_POST['submit'] == 'Guardar') {
                $customerData = array(
                    'id' => null,
                    'sexo' => (isset($_POST['sexo'])) ? $_POST['sexo'] : "",
                    'telefono' => (isset($_POST['telefono'])) ? $_POST['telefono'] : "",
                    'nacimiento' => (isset($_POST['nacimiento'])) ? $_POST['nacimiento'] : "",
                    'state' => (isset($_POST['state'])) ? $_POST['state'] : "",
                    'nif' => (isset($_POST['nif'])) ? $_POST['nif'] : "",
                    'email' => (isset($_POST['email'])) ? $_POST['email'] : "",
                    'nombre' => (isset($_POST['nombre'])) ? $_POST['nombre'] : "",
                    'apellidos' => (isset($_POST['apellidos'])) ? $_POST['apellidos'] : "",
                    'calle' => (isset($_POST['calle'])) ? $_POST['calle'] : "",
                    'numero' => (isset($_POST['numero'])) ? $_POST['numero'] : "",
                    'pisoLetra' => (isset($_POST['pisoLetra'])) ? $_POST['pisoLetra'] : "",
                    'cp' => (isset($_POST['cp'])) ? $_POST['cp'] : "",
                    'ciudad' => (isset($_POST['ciudad'])) ? $_POST['ciudad'] : "",
                    'provincia' => (isset($_POST['provincia'])) ? $_POST['provincia'] : "",
                );
                $_SESSION['customer'] = json_encode($customerData);
                $customer = new Customer($customerData);

                $surveyData = array(
                    'id' => null,
                    'order' => (isset($_POST['order'])) ? $_POST['order'] : "",
                    'edad' => $customer->getNacimiento(),
                    'sexo' => $customer->getSexo(),
                    'altura' => (isset($_POST['altura'])) ? $_POST['altura'] : "",
                    'peso' => (isset($_POST['peso'])) ? $_POST['peso'] : "",
                    'per_m' => (isset($_POST['per_m'])) ? $_POST['per_m'] : "",
                    'per_ci' => (isset($_POST['per_ci'])) ? $_POST['per_ci'] : "",
                    'per_ca' => (isset($_POST['per_ca'])) ? $_POST['per_ca'] : "",
                    'peso_infancia' => (isset($_POST['peso_infancia'])) ? $_POST['peso_infancia'] : "",
                    'peso_adulto_estable' => (isset($_POST['peso_adulto_estable'])) ? $_POST['peso_adulto_estable'] : "",
                    'peso_adulto_minimo' => (isset($_POST['peso_adulto_minimo'])) ? $_POST['peso_adulto_minimo'] : "",
                    'peso_adulto_maximo' => (isset($_POST['peso_adulto_maximo'])) ? $_POST['peso_adulto_maximo'] : "",
                    'peso_ultimo' => (isset($_POST['peso_ultimo'])) ? $_POST['peso_ultimo'] : "",
                    'dieta_ultimo' => (isset($_POST['dieta_ultimo'])) ? $_POST['dieta_ultimo'] : "",
                    'embarazada' => (isset($_POST['embarazada'])) ? $_POST['embarazada'] : "",
                    'embarazada_tiempo_bebe' => (isset($_POST['embarazada_tiempo_bebe'])) ? $_POST['embarazada_tiempo_bebe'] : "",
                    'causa_kilos' => (isset($_POST['causa_kilos'])) ? $_POST['causa_kilos'] : "",
                    'peso_comodo' => (isset($_POST['peso_comodo'])) ? $_POST['peso_comodo'] : "",
                    'ultima_analitica' => (isset($_POST['ultima_analitica'])) ? $_POST['ultima_analitica'] : "",
                    'ultima_analitica_txt' => (isset($_POST['ultima_analitica_txt'])) ? $_POST['ultima_analitica_txt'] : "",
                    'estado_general' => (isset($_POST['estado_general'])) ? $_POST['estado_general'] : "",
                    'estado_general_txt' => (isset($_POST['estado_general_txt'])) ? $_POST['estado_general_txt'] : "",
                    'medicamento' => (isset($_POST['medicamento'])) ? $_POST['medicamento'] : "",
                    'medicamento_txt' => (isset($_POST['medicamento_txt'])) ? $_POST['medicamento_txt'] : "",
                    'quirofano' => (isset($_POST['quirofano'])) ? $_POST['quirofano'] : "",
                    'quirofano_txt' => (isset($_POST['quirofano_txt'])) ? $_POST['quirofano_txt'] : "",
                    'reglas' => (isset($_POST['reglas'])) ? $_POST['reglas'] : "",
                    'tension' => (isset($_POST['tension'])) ? $_POST['tension'] : "",
                    'digestiones' => (isset($_POST['digestiones'])) ? $_POST['digestiones'] : "",
                    'bano' => (isset($_POST['bano'])) ? $_POST['bano'] : "",
                    'alcohol' => (isset($_POST['alcohol'])) ? $_POST['alcohol'] : "",
                    'tabaco' => (isset($_POST['tabaco'])) ? $_POST['tabaco'] : "",
                    'rutina' => (isset($_POST['rutina'])) ? $_POST['rutina'] : "",
                    'cama' => (isset($_POST['cama'])) ? $_POST['cama'] : "",
                    'caminar' => (isset($_POST['caminar'])) ? $_POST['caminar'] : "",
                    'deporte' => (isset($_POST['deporte'])) ? $_POST['deporte'] : "",
                    'deporte_txt' => (isset($_POST['deporte_txt'])) ? $_POST['deporte_txt'] : "",
                    'desayunos_txt' => (isset($_POST['desayunos_txt'])) ? $_POST['desayunos_txt'] : "",
                    'media_manana_txt' => (isset($_POST['media_manana_txt'])) ? $_POST['media_manana_txt'] : "",
                    'meriendas_txt' => (isset($_POST['meriendas_txt'])) ? $_POST['meriendas_txt'] : "",
                    'postre_txt' => (isset($_POST['postre_txt'])) ? $_POST['postre_txt'] : "",
                    'postcena_txt' => (isset($_POST['postcena_txt'])) ? $_POST['postcena_txt'] : "",
                    'bebida_en_comidas' => (isset($_POST['bebida_en_comidas'])) ? $_POST['bebida_en_comidas'] : "",
                    'veces_fuera_casa' => (isset($_POST['veces_fuera_casa'])) ? $_POST['veces_fuera_casa'] : "",
                    'fuera_casa_trabajo' => (isset($_POST['fuera_casa_trabajo'])) ? $_POST['fuera_casa_trabajo'] : "",
                    'picoteas' => (isset($_POST['picoteas'])) ? $_POST['picoteas'] : "",
                    'ansiedad_comida' => (isset($_POST['ansiedad_comida'])) ? $_POST['ansiedad_comida'] : "",
                    'leche' => (isset($_POST['leche'])) ? $_POST['leche'] : "",
                    'carne_roja' => (isset($_POST['carne_roja'])) ? $_POST['carne_roja'] : "",
                    'pescado' => (isset($_POST['pescado'])) ? $_POST['pescado'] : "",
                    'huevos' => (isset($_POST['huevos'])) ? $_POST['huevos'] : "",
                    'verduras' => (isset($_POST['verduras'])) ? $_POST['verduras'] : "",
                    'fruta' => (isset($_POST['fruta'])) ? $_POST['fruta'] : "",
                    'legumbres' => (isset($_POST['legumbres'])) ? $_POST['legumbres'] : "",
                    'patatas' => (isset($_POST['patatas'])) ? $_POST['patatas'] : "",
                    'pan' => (isset($_POST['pan'])) ? $_POST['pan'] : "",
                    'comida_rapida' => (isset($_POST['comida_rapida'])) ? $_POST['comida_rapida'] : "",
                    'precocinada' => (isset($_POST['precocinada'])) ? $_POST['precocinada'] : "",
                    'snacks' => (isset($_POST['snacks'])) ? $_POST['snacks'] : "",
                    'bolleria' => (isset($_POST['bolleria'])) ? $_POST['bolleria'] : "",
                    'intolerancia_txt' => (isset($_POST['intolerancia_txt'])) ? $_POST['intolerancia_txt'] : "",
                    'vegetariana_txt' => (isset($_POST['vegetariana_txt'])) ? $_POST['vegetariana_txt'] : "",
                    'sin_gracia' => (isset($_POST['sin_gracia'])) ? $_POST['sin_gracia'] : "",
                    'con_gracia' => (isset($_POST['con_gracia'])) ? $_POST['con_gracia'] : "",
                    'trabajo' => (isset($_POST['trabajo'])) ? $_POST['trabajo'] : "",
                    'unico' => (isset($_POST['unico'])) ? $_POST['unico'] : "",
                    'comentarios' => (isset($_POST['comentarios'])) ? $_POST['comentarios'] : "",
                    'paciente_nombre' => $customer->getNombre(),
                    'paciente_apellidos' => $customer->getApellidos(),
                    'paciente_nif' => $customer->getNif(),
                    'paciente_email' => $customer->getEmail(),
                    'paciente_repite' => $customer->getEmail(),
                    'paciente_telefono' => $customer->getTelefono(),
                    'paciente_calle' => $customer->getCalle(),
                    'paciente_numero' => $customer->getNumero(),
                    'paciente_piso_letra' => $customer->getPisoLetra(),
                    'paciente_cp' => $customer->getCp(),
                    'paciente_ciudad' => $customer->getCiudad(),
                    'paciente_provincia' => $customer->getProvincia(),
                    'newsletter' => (isset($_POST['newsletter'])) ? $_POST['newsletter'] : "off"
                );
                $_SESSION['survey'] = json_encode($surveyData);


                $payment = new AleaCRMPayment("999008881", "1", "978", "0", home_url('registrado'));
                $payment->pay_data(time(), "5000", "Solicitud de consulta inicial");
                $json_data = '{"description": "Solicitud de consulta inicial"}';
                $payment->request_pay($json_data);
            } else {
                $survey = new StartSurvey();
                $customer = new Customer();
?>
                <form action="" method="POST" id="survey">
                    <?php
                    SELF::startSurvey($survey, $customer);
                    ?>
                </form>
                <?php
            }
        }


        public static function continueSurveyApply()
        {

            global $wp;
            $_SESSION['tipo'] = "2";

            if (isset($_POST['submit']) && $_POST['submit'] == 'Guardar') {
                $surveyData = array(
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
                $_SESSION['survey'] = json_encode($surveyData);

                $survey = new ContinueSurvey($surveyData);
                $customer = new Customer();
                $customer->getCustomerByNIF($survey->getpaciente_nif());
                $_SESSION['customer'] = json_encode($customer->toArray());


                $payment = new AleaCRMPayment("999008881", "1", "978", "0", home_url('registrado'));
                $payment->pay_data(time(), "2500", "Solicitud de consulta de seguimiento");
                $json_data = '{"description": "Solicitud de consulta de seguimiento"}';
                $payment->request_pay($json_data);
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
                    <form action="" method="POST" id="survey">
                        <?php
                        SELF::continueSurvey($survey, $customer);
                        ?>
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

        private static function graciasForm()
        {
            ?>
            <h2>¡Muchas gracias, tu solicitud ha sido correctamente registrada!</h2>
        <?php
        }


        public static function startSurvey($survey, $customer)
        {
            SurveyController::SurveySection(0, 5, false, false, true, '', SurveyController::start_welcome());
            SurveyController::SurveySection(1, 5, true, true, true, 'Vamos a empezar con algunos datos de tu salud', SurveyController::customer_profile($customer) . SurveyController::start_bodyMeasures($survey) . SurveyController::start_weightEvolution($survey));
            SurveyController::SurveySection(2, 5, true, true, true, 'Ahora charlaremos de otros aspectos importantes', SurveyController::start_analitycs($survey) . SurveyController::start_pathology($survey) . SurveyController::start_unhealthy($survey) . SurveyController::start_exercise($survey));
            SurveyController::SurveySection(3, 5, true, true, true, 'Es hora de que nos cuentes cómo te alimentas', SurveyController::start_nutrition($survey) . SurveyController::start_foodFreq($survey));
            SurveyController::SurveySection(4, 5, true, true, true, '¿Cómo te gustaría que fuera tu dieta?', SurveyController::start_desiredDiet($survey));
            SurveyController::SurveySection(5, 5, true, true, false, 'Por último, tus datos personales', SurveyController::customer_data($customer) . SurveyController::discountCode($survey) . SurveyController::privacy_terms() . SurveyController::newsletter($survey) . SurveyController::send());
        }

        public static function startSurveyData($survey, $customer)
        {
            SurveyController::SurveySection(0, 5, false, false, false, '', SurveyController::customer_profile($customer) . SurveyController::start_bodyMeasures($survey) . SurveyController::start_weightEvolution($survey));
            SurveyController::SurveySection(0, 5, false, false, false, '', SurveyController::start_analitycs($survey) . SurveyController::start_pathology($survey) . SurveyController::start_unhealthy($survey) . SurveyController::start_exercise($survey));
            SurveyController::SurveySection(0, 5, false, false, false, '', SurveyController::start_nutrition($survey) . SurveyController::start_foodFreq($survey));
            SurveyController::SurveySection(0, 5, false, false, false, '', SurveyController::start_desiredDiet($survey));
            SurveyController::SurveySection(0, 5, false, false, false, '', SurveyController::customer_data($customer) . SurveyController::discountCode($survey) . SurveyController::privacy_terms() . SurveyController::newsletter($survey));
        }

        public static function continueSurvey($survey, $customer)
        {
            SurveyController::SurveySection(1, 3, false, false, true, $customer->getNombre() . ', ¿Cómo te ha ido?', SurveyController::continue_seguimiento($survey));
            SurveyController::SurveySection(2, 3, true, true, true, 'Los datos de tu evolución', SurveyController::continue_bodyMeasures($survey));
            SurveyController::SurveySection(3, 3, true, true, false, '¿Quieres comentarnos alguna cosa más?', SurveyController::continue_comments($survey) . SurveyController::privacy_terms($survey) . SurveyController::send());
        }
        public static function continueSurveyData($survey, $customer)
        {
            SurveyController::SurveySection(0, 3, false, false, false, '', SurveyController::continue_seguimiento($survey));
            SurveyController::SurveySection(0, 3, false, false, false, '', SurveyController::continue_bodyMeasures($survey));
            SurveyController::SurveySection(0, 3, false, false, false, '', SurveyController::continue_comments($survey));
        }
    } // EOC
} // namespace
