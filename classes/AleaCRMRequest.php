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

        private static function customerInfoForm($tipoDieta, $fechaConsulta, $dietaId, $customer)
        {
        ?>
            <div class="flex flex-wrap w-full bg-gray-100 rounded-xl shadow-xl">

                <div class="flex justify-center lateral w-2/12">
                    REGRESAR
                </div>
                <div class="lateral w-10/12">
                    Espaciador
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
                <div class="flex justify-end w-2/12">
                    <label>tipoDieta: </label>
                </div>
                <div class="w-10/12 justify-start">
                    <?= $tipoDieta; ?>
                </div>
                <div class="flex justify-end w-2/12">
                    <label>fechaConsulta: </label>
                </div>
                <div class="w-10/12 justify-start">
                    <?= $fechaConsulta; ?>
                </div>
                <div class="flex justify-end w-2/12">
                    <label>dietaId: </label>
                </div>
                <div class="w-10/12 justify-start">
                    <?= $dietaId; ?>
                </div>
                <div class="flex justify-end w-2/12">
                    <label>customer: </label>
                </div>
                <div class="w-10/12 justify-start">
                    <?= $customer->getNacimiento(); ?>
                </div>
                <div class="flex justify-end w-2/12">
                    <label>customer: </label>
                </div>
                <div class="w-10/12 justify-start">
                    <?= $customer->getSexo(); ?>
                </div>
            </div>

        <?php
        }


        private static function customerDietDetail($customerDiet)
        {
            $customer = $customerDiet['customer'];
            $diet = $customerDiet['diet'];
            $surveyData = json_decode(str_replace("#", "\"", $diet->getParametros()), true);;
            $survey = ($diet->getTipo() == 1) ? new StartSurvey($surveyData) :  new ContinueSurvey($surveyData);

            SELF::customerInfoForm($diet->getTipo(), $diet->getFecha(), $diet->getId(), $customer);
        ?>

            <?php
            if ($diet->getTipo() == 1) {
                //AleaSurvey::startSurvey($survey);
            } elseif ($diet->getTipo() == 2) {

                //AleaSurvey::continueSurvey($survey);
            } else {
                echo "Sorry, we don't have any template for this critearia.";
            }
            ?>
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
            SELF::customerDietDetail($customerData);
        }
    } // EOC
} // namespace