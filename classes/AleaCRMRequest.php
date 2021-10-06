<?php

namespace JWR\Alea {

    use JWR\Alea\Utils;

    class AleaCRMRequest
    {
        public static function createRequestPages()
        {
            Utils::createPage("Alea CRM Request", "request", "alea-request", "jwr-alea-crm-request-id", "templates/page-crm.php");
        }
        public static function deleteRequestPages()
        {
            Utils::deletePage("jwr-alea-crm-request-id");
        }

        public static function requestPages()
        {
            $page = (!isset($_GET['pag'])) ? 1 : Utils::escape($_GET['pag']);

            if (isset($_GET['customer']) && $_GET['customer'] != '') { // p.e. 44608

                $customer = UTILS::escape($_GET['customer']);
                SELF::listCustomerDietsPerCusomer($customer, $page);
            } else if (isset($_GET['diet']) && $_GET['diet'] != '') { // 27163

                $diet_id = UTILS::escape($_GET['diet']);
                SELF::showCustomerDiet($diet_id);
            } else {

                SELF::listCustomerDiets($page);
                SELF::paginator($page);
            }
        }

        private static function listCustomerDietsForm($customerDiets, $page)
        {
            global $wp;
?>
            <div class="container bg-gray-100 shadow-xl">
                <div class="flex justify-around text-center bg-red-400 rounded-lg text-gray-50">
                    <div class="w-2/12">Fecha</div>
                    <div class="w-6/12">Nombre Completo</div>
                    <div class="w-2/12">Modo</div>
                    <div class="w-2/12"></div>
                </div>
                <?php foreach ($customerDiets as $diet) :
                    $link_arg = (isset($_GET['customer'])) ? "diet" . '=' . $diet->getId() : "customer" . '=' . $diet->getCliente();
                ?>
                    <div class="container flex justify-around align-middle text-gray-800 text-xs">
                        <div class="w-2/12"><?= $diet->getFecha(); ?></div>
                        <div class="w-6/12 text-center"><a href="<?= home_url($wp->request) . '?' . $link_arg; ?>"><?= $diet->getNombre() . " " . $diet->getApellidos(); ?></a></div>
                        <div class="w-2/12"><?= $diet->getTipo(); ?></div>
                        <div class="w-2/12">
                            <button class="printOption" onclick="printOption('<?= $diet->getId(); ?>')" data-id="<? $diet->getId(); ?>">
                                <?php if ($diet->getEnviado() == 1) : ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                    </svg> <?php else : ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                <?php endif ?>
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php
        }

        private static function customerDietForm($customerDiet)
        {
            global $wp;
            $customer = $customerDiet['customer'];
            $diet = $customerDiet['diet'];

            $surveyData = json_decode(str_replace("#", "\"", $diet->getParametros()), true);;

            $survey = ($diet->getTipo() == 1) ? new StartSurvey($surveyData) :  new ContinueSurvey($surveyData);
            echo "<pre>";
            print_r($customer);
            print_r($diet);
            print_r($survey);
            echo "</pre>";







        ?>
            <div class="container bg-gray-100 shadow-xl">
                <?= $customer->getApellidos(); ?>
                <?= $customer->getNombre(); ?>
                <?= $customer->getNif(); ?>
                <?= $customer->getTelefono(); ?>
                <?= $customer->getEmail(); ?>
                <?= $diet->getTipo(); ?>
                <?= $diet->getFecha(); ?>
                <?= $diet->getId(); ?>
                <?= $customer->getNacimiento(); ?>
                <?= $customer->getSexo(); ?>

                <!-- inicia -->
                <?php if ($diet->getTipo() == 1) : ?>
                    <div><label>order: </label> <?= $survey->getorder(); ?></div>
                    <div><label>edad: </label> <?= $survey->getedad(); ?></div>
                    <div><label>sexo: </label> <?= $survey->getsexo(); ?></div>
                    <div><label>altura: </label> <?= $survey->getaltura(); ?></div>
                    <div><label>peso: </label> <?= $survey->getpeso(); ?></div>
                    <div><label>per_m: </label> <?= $survey->getper_m(); ?></div>
                    <div><label>per_ci: </label> <?= $survey->getper_ci(); ?></div>
                    <div><label>per_ca: </label> <?= $survey->getper_ca(); ?></div>
                    <div><label>peso_infancia: </label> <?= $survey->getpeso_infancia(); ?></div>
                    <div><label>peso_adulto_estable: </label> <?= $survey->getpeso_adulto_estable(); ?></div>
                    <div><label>peso_adulto_minimo: </label> <?= $survey->getpeso_adulto_minimo(); ?></div>
                    <div><label>peso_adulto_maximo: </label> <?= $survey->getpeso_adulto_maximo(); ?></div>
                    <div><label>peso_ultimo: </label> <?= $survey->getpeso_ultimo(); ?></div>
                    <div><label>dieta_ultimo: </label> <?= $survey->getdieta_ultimo(); ?></div>
                    <div><label>embarazada: </label> <?= $survey->getembarazada(); ?></div>
                    <div><label>embarazada_tiempo_bebe: </label> <?= $survey->getembarazada_tiempo_bebe(); ?></div>
                    <div><label>causa_kilos: </label> <?= $survey->getcausa_kilos(); ?></div>
                    <div><label>peso_comodo: </label> <?= $survey->getpeso_comodo(); ?></div>
                    <div><label>ultima_analitica: </label> <?= $survey->getultima_analitica(); ?></div>
                    <div><label>ultima_analitica_txt: </label> <?= $survey->getultima_analitica_txt(); ?></div>
                    <div><label>estado_general: </label> <?= $survey->getestado_general(); ?></div>
                    <div><label>estado_general_txt: </label> <?= $survey->getestado_general_txt(); ?></div>
                    <div><label>medicamento: </label> <?= $survey->getmedicamento(); ?></div>
                    <div><label>medicamento_txt: </label> <?= $survey->getmedicamento_txt(); ?></div>
                    <div><label>quirofano: </label> <?= $survey->getquirofano(); ?></div>
                    <div><label>quirofano_txt: </label> <?= $survey->getquirofano_txt(); ?></div>
                    <div><label>reglas: </label> <?= $survey->getreglas(); ?></div>
                    <div><label>tension: </label> <?= $survey->gettension(); ?></div>
                    <div><label>digestiones: </label> <?= $survey->getdigestiones(); ?></div>
                    <div><label>bano: </label> <?= $survey->getbano(); ?></div>
                    <div><label>alcohol: </label> <?= $survey->getalcohol(); ?></div>
                    <div><label>tabaco: </label> <?= $survey->gettabaco(); ?></div>
                    <div><label>rutina: </label> <?= $survey->getrutina(); ?></div>
                    <div><label>cama: </label> <?= $survey->getcama(); ?></div>
                    <div><label>caminar: </label> <?= $survey->getcaminar(); ?></div>
                    <div><label>deporte: </label> <?= $survey->getdeporte(); ?></div>
                    <div><label>deporte_txt: </label> <?= $survey->getdeporte_txt(); ?></div>
                    <div><label>desayunos_txt: </label> <?= $survey->getdesayunos_txt(); ?></div>
                    <div><label>media_manana_txt: </label> <?= $survey->getmedia_manana_txt(); ?></div>
                    <div><label>meriendas_txt: </label> <?= $survey->getmeriendas_txt(); ?></div>
                    <div><label>postre_txt: </label> <?= $survey->getpostre_txt(); ?></div>
                    <div><label>postcena_txt: </label> <?= $survey->getpostcena_txt(); ?></div>
                    <div><label>bebida_en_comidas: </label> <?= $survey->getbebida_en_comidas(); ?></div>
                    <div><label>veces_fuera_casa: </label> <?= $survey->getveces_fuera_casa(); ?></div>
                    <div><label>fuera_casa_trabajo: </label> <?= $survey->getfuera_casa_trabajo(); ?></div>
                    <div><label>picoteas: </label> <?= $survey->getpicoteas(); ?></div>
                    <div><label>ansiedad_comida: </label> <?= $survey->getansiedad_comida(); ?></div>
                    <div><label>leche: </label> <?= $survey->getleche(); ?></div>
                    <div><label>carne_roja: </label> <?= $survey->getcarne_roja(); ?></div>
                    <div><label>pescado: </label> <?= $survey->getpescado(); ?></div>
                    <div><label>huevos: </label> <?= $survey->gethuevos(); ?></div>
                    <div><label>verduras: </label> <?= $survey->getverduras(); ?></div>
                    <div><label>fruta: </label> <?= $survey->getfruta(); ?></div>
                    <div><label>legumbres: </label> <?= $survey->getlegumbres(); ?></div>
                    <div><label>patatas: </label> <?= $survey->getpatatas(); ?></div>
                    <div><label>pan: </label> <?= $survey->getpan(); ?></div>
                    <div><label>comida_rapida: </label> <?= $survey->getcomida_rapida(); ?></div>
                    <div><label>precocinada: </label> <?= $survey->getprecocinada(); ?></div>
                    <div><label>snacks: </label> <?= $survey->getsnacks(); ?></div>
                    <div><label>bolleria: </label> <?= $survey->getbolleria(); ?></div>
                    <div><label>intolerancia_txt: </label> <?= $survey->getintolerancia_txt(); ?></div>
                    <div><label>vegetariana_txt: </label> <?= $survey->getvegetariana_txt(); ?></div>
                    <div><label>sin_gracia: </label> <?= $survey->getsin_gracia(); ?></div>
                    <div><label>con_gracia: </label> <?= $survey->getcon_gracia(); ?></div>
                    <div><label>trabajo: </label> <?= $survey->gettrabajo(); ?></div>
                    <div><label>unico: </label> <?= $survey->getunico(); ?></div>
                    <div><label>comentarios: </label> <?= $survey->getcomentarios(); ?></div>
                    <div><label>paciente_nombre: </label> <?= $survey->getpaciente_nombre(); ?></div>
                    <div><label>paciente_apellidos: </label> <?= $survey->getpaciente_apellidos(); ?></div>
                    <div><label>paciente_nif: </label> <?= $survey->getpaciente_nif(); ?></div>
                    <div><label>paciente_email: </label> <?= $survey->getpaciente_email(); ?></div>
                    <div><label>paciente_repite: </label> <?= $survey->getpaciente_repite(); ?></div>
                    <div><label>paciente_telefono: </label> <?= $survey->getpaciente_telefono(); ?></div>
                    <div><label>paciente_calle: </label> <?= $survey->getpaciente_calle(); ?></div>
                    <div><label>paciente_numero: </label> <?= $survey->getpaciente_numero(); ?></div>
                    <div><label>paciente_piso_letra: </label> <?= $survey->getpaciente_piso_letra(); ?></div>
                    <div><label>paciente_cp: </label> <?= $survey->getpaciente_cp(); ?></div>
                    <div><label>paciente_ciudad: </label> <?= $survey->getpaciente_ciudad(); ?></div>
                    <div><label>paciente_provincia: </label> <?= $survey->getpaciente_provincia(); ?></div>
                    <div><label>newsletter: </label> <?= $survey->getnewsletter(); ?></div>

                <?php elseif ($diet->getTipo() == 2) : ?>

                    <!-- continua -->
                    <div><label>order: </label> <?= $survey->getorder(); ?> </div>
                    <div><label>estricta: </label> <?= $survey->getestricta(); ?> </div>
                    <div><label>pesado: </label> <?= $survey->getpesado(); ?> </div>
                    <div><label>fuera_casa: </label> <?= $survey->getfuera_casa(); ?> </div>
                    <div><label>picoteado: </label> <?= $survey->getpicoteado(); ?> </div>
                    <div><label>cocinado: </label> <?= $survey->getcocinado(); ?> </div>
                    <div><label>cambios: </label> <?= $survey->getcambios(); ?> </div>
                    <div><label>hambre: </label> <?= $survey->gethambre(); ?> </div>
                    <div><label>ansiedad: </label> <?= $survey->getansiedad(); ?> </div>
                    <div><label>echas_menos: </label> <?= $survey->getechas_menos(); ?> </div>
                    <div><label>gustado: </label> <?= $survey->getgustado(); ?> </div>
                    <div><label>gustado_txt: </label> <?= $survey->getgustado_txt(); ?> </div>
                    <div><label>menores: </label> <?= $survey->getmenores(); ?> </div>
                    <div><label>menores_txt: </label> <?= $survey->getmenores_txt(); ?> </div>
                    <div><label>digestiones: </label> <?= $survey->getdigestiones(); ?> </div>
                    <div><label>bano: </label> <?= $survey->getbano(); ?> </div>
                    <div><label>ejercicio: </label> <?= $survey->getejercicio(); ?> </div>
                    <div><label>altura: </label> <?= $survey->getaltura(); ?> </div>
                    <div><label>peso: </label> <?= $survey->getpeso(); ?> </div>
                    <div><label>per_ci: </label> <?= $survey->getper_ci(); ?> </div>
                    <div><label>per_ca: </label> <?= $survey->getper_ca(); ?> </div>
                    <div><label>comentarios: </label> <?= $survey->getcomentarios(); ?> </div>
                    <div><label>paciente_nif: </label> <?= $survey->getpaciente_nif(); ?> </div>

                <?php endif ?>

            </div>

        <?php
        }

        private static function listCustomerDiets($page)
        {
            $customerDiet  = new CustomerDiet;

            $customerDiets = $customerDiet->getCustomerDietPaged($page);
            SELF::listCustomerDietsForm($customerDiets, $page);
        }

        private static function paginator($pag)
        {
            global $wp;
            $data = CustomerDiet::paginatorData();
        ?>
            <div class="flex justify-center space-x-8">
                <a href="<?= home_url($wp->request) . '/?pag=1' ?>">
                    <div>
                        << </div>
                </a>
                <?php if ($pag >= 25) : ?>
                    <a href="<?= home_url($wp->request) . '/?pag=' . ($pag - 20) ?>">
                        <div>
                            << </div>
                    </a>
                <?php endif; ?>
                <?php
                $inicia = ($pag - 7 <= 1) ? 1 : $pag - 7;
                $fin = ($pag + 7 >= $data['num_pags']) ? $data['num_pags'] : $pag + 7;
                ?>

                <?php for ($i = $inicia; $i <= $fin; $i++) : ?>
                    <a href="<?= home_url($wp->request) . '/?pag=' . $i; ?>" class=" <?php echo ($pag == $i) ? 'selected' : ''; ?>">
                        <div><?= $i; ?></div>
                    </a>
                <?php endfor; ?>
                <?php if ($data['num_pags'] >= ($pag + 25)) : ?>
                    <a href="<?= home_url($wp->request) . '/?pag=' . ($pag + 20) ?>">
                        <div>
                            >> </div>
                    </a>
                <?php endif; ?>
                <a href="<?= home_url($wp->request) . '/?pag=' . $data['num_pags']; ?>">
                    <div> >> </div>
                </a>
            </div>
            <div class="flex justify-center text-center">
                <?= $data['total']; ?> registros.
            </div>
<?php

        }

        private static function listCustomerDietsPerCusomer($customer, $page)
        {
            $customerDiet  = new CustomerDiet;


            $customerDiets = $customerDiet->getCustomerDietsByCustomerId($customer);

            SELF::listCustomerDietsForm($customerDiets, $page);
        }

        private static function showCustomerDiet($diet_id)
        {
            $customerDiet  = new CustomerDiet;


            $customerData = $customerDiet->getCustomerDietById($diet_id);
            SELF::customerDietForm($customerData);
        }
    } // EOC
} // namespace