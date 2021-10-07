<?php

namespace JWR\Alea {

    if (!defined('ABSPATH')) {
        exit;
    }

    // require_once WP_PLUGIN_DIR."/jwr-alea-crm/classes/AleaCRMDiet.php";
    // require_once WP_PLUGIN_DIR."/jwr-alea-crm/classes/AleaCRMInvoice.php";
    // require_once WP_PLUGIN_DIR."/jwr-alea-crm/classes/AleaCRMRequest.php";
    // require_once WP_PLUGIN_DIR."/jwr-alea-crm/classes/AleaExportXLS.php";
    // require_once WP_PLUGIN_DIR."/jwr-alea-crm/classes/AleaSurvey.php";
    // require_once WP_PLUGIN_DIR."/jwr-alea-crm/classes/Utils.php";
    // require_once(WP_PLUGIN_DIR."/jwr-alea-crm/model/AleaModel.php");
    // require_once(WP_PLUGIN_DIR."/jwr-alea-crm/model/Customer.php");
    // require_once(WP_PLUGIN_DIR."/jwr-alea-crm/model/Dieta.php");
    // require_once(WP_PLUGIN_DIR."/jwr-alea-crm/model/Factura.php");

    use JWR\Alea\{AleaCRMRequest, AleaCRMDiet, AleaCRMInvoice, AleaModel, AleaSurvey, AleaExportXLS, Customer, Factura, Dieta};

    class AleaCRM
    {
        public function __construct()
        {
            return;
        }

        public static function createCRMPages()
        {
            AleaCRMRequest::createRequestPages();
            AleaCRMDiet::createDietPages();
            AleaCRMInvoice::createInvoicePages();
            AleaSurvey::createSurveyPages();
            AleaExportXLS::createExportPage();
        }

        public static function deleteCRMPages()
        {
            AleaCRMRequest::deleteRequestPages();
            AleaCRMDiet::deleteDietPages();
            AleaCRMInvoice::deleteInvoicePages();
            AleaSurvey::deleteSurveyPages();
            AleaExportXLS::deleteExportPage();
        }

        public static function testModel()
        {
            AleaModel::test();
        }

        public static function createTables()
        {
            AleaModel::createTables();
        }

        public static function deleteTables()
        {
            AleaModel::deleteTables();
        }

        public static function create_menu_admin()
        {
            add_menu_page(
                'JwR Alea CRM', //get_plugin_data(__FILE__),
                'Alea CRM',
                'manage_options',
                'jwr-crm-config',
                array(SELF::class, 'admin_options'),
                null,
                55
            );

            add_submenu_page(
                'jwr-crm-config',
                'Migración de datos',
                'Migración',
                'manage_options',
                'admin-migration',
                array(SELF::class, 'admin_data_migrations'),
                null
            );
            add_submenu_page(
                'jwr-crm-config',
                'Aministración de encuestas',
                'Encuestas',
                'manage_options',
                'admin-surveys',
                array(SELF::class, 'admin_surveys'),
                null
            );
            add_submenu_page(
                'jwr-crm-config',
                'Reporte especializado de datos',
                'Reportes',
                'manage_options',
                'admin-reports',
                array(SELF::class, 'admin_reports'),
                null
            );
            add_submenu_page(
                'jwr-crm-config',
                'CRM REST API',
                'CRM API',
                'manage_options',
                'admin-API',
                array(SELF::class, 'admin_api'),
                null
            );
        }

        // content plugin admin

        public static function admin_options()
        {
            echo "<h1>" . get_admin_page_title() . "</h1>";
            echo "<br>";
            echo get_page_template('pag1');
            echo "<br>";
            echo plugin_dir_path(__FILE__) . 'admin/pag1.php';
            echo "<br>";
            echo plugins_url('admin/pag1.php', __FILE__);
            echo "<br>";
            echo get_template_directory();
?>
            <h2 class="title">Subtitulo de mi admin</h2>
            <p>Pasándome de rosca con el hardcodeo.</p>
        <?php
        }

        public static function admin_data_migrations()
        {
            echo "<h1>" . get_admin_page_title() . "</h1>";
        ?>
            <p>.</p>
            <h2 class="title">RESPALDO DE SEGURIDAD</h2>
            <p>Ésta fase no tiene la opción de respaldo de seguridad de sus datos.</p>
        <?php
        }

        public static function admin_surveys()
        {
            echo "<h1>" . get_admin_page_title() . "</h1>";
        ?>
            <p>En esta fase no tiene encuestas generadas automáticamente. Las encuestas realizadas son fijas y los datos obtenidos son guarados como en la versión básica de este CRM.</p>
            <h2 class="title">¡PIDE TU COTIZACIÓN AHORA Y DALE ESE IMPULSO A TU CRM!</h2>

        <?php
        }

        public static function admin_reports()
        {
            echo "<h1>" . get_admin_page_title() . "</h1>";
        ?>
            <p>
                No tienes reportes. :(
            </p>
            <p>Recuerda que algo muy importante para las grandes empresas es conocer los datos de sus clientes,
                los reportes te ayudarán a conocer cuántos, cuándo, cómo y qué servicios son más requerido, ayudará
                a la toma de decisiones para el crecimiento de tu empresa y te ayudará a prevenir conflictos y
                hacer proyecciones de venta.
            </p>

            <h2 class="title">¡PIDE TU COTIZACIÓN AHORA!</h2>
        <?php
        }

        public static function admin_api()
        {
            echo "<h1>" . get_admin_page_title() . "</h1>";
        ?>
            <p>La tecnología avanza, y nosotros con ella. ¿Sabías que podrías trabajar en el CRM aunque o se te valla el internet?,
                ¿Sabías que los diseños más actuales hacen uso de REST API para llevar los CRM a aplicaciónes al móvil?. </p>
            <h2 class="title">¡TU CMR ESTÁ LISTO PARA CRECER!</h2>
            <p>Así es, éste CRM está listo para una pronta implementación de su API, aquí puedes ver un ejemplo de los datos:
                <a href="<?= get_home_url() . "/wp-json/alea-crm/customer/12"; ?>" target="_blank">ALEA CRM Customer Endpoint API</a>.
                Con esta API puedes implementar tu CRM con tecnologías WPA, SPW o crear una APP que se conecte a éste servicio.
            </p>

            <h2 class="title">¡PREGÚNTANOS CÓMO!</h2>

<?php
        }


        // Shortcodes section
        /**
         * shortodes
         */
        function shortcode_test($atts = [], $content = null, $tag = '')
        {
            ob_start();

            var_dump($_GET);
            global $wp_query;
            if (isset($wp_query->query['test'])) {
                echo "entro";
            }
            echo "<h1>Pruebita de Shortcode</h1>";

            $url = get_rest_url() . 'alea-crm/customer/1/2/';
            print_r($url);
            echo "<br />";
            $response = file_get_contents($url);
            if ($response) {
                $response_results = json_decode($response);
                echo "<pre>";
                //            var_dump($response_results);
                echo $response_results->data[0]->email;
                echo "</pre>";
            }

            $atts = array_change_key_case((array) $atts, CASE_LOWER);
            echo "<h1>Customer TEST</h1>";

            $data = array(
                'sexo' => 1,
                'telefono' => 'telefono',
                'fecha' => '2022-01-20',
                'state' => 1,
                'nif' => 'nif',
                'email' => 'email',
                'nombre' => 'nombre_prueba',
                'apellidos' => 'apellidos',
                'calle' => 'calle',
                'numero' => 1,
                'pisoLetra' => 'piso',
                'cp' => 'cp',
                'ciudad' => 'ciudad',
                'provincia' => 'provincia'
            );

            $customer  = new Customer($data);
            echo "<br />";
            echo $customer->getNombre();

            echo "<br />";
            $newCustomer = $customer->getCustomerById($customer->save());
            echo "<pre>";
            var_dump($newCustomer);
            echo "</pre>";

            echo "<h1>Factura TEST</h1>";

            $data = array(
                'id' => null,
                'referencia' => 'referencia',
                'fecha' => '2022-01-20',
                'cliente' => 1,
                'dietaid' => 1,
                'nombre' => 'nombre',
                'apellidos' => 'apellidos',
                'nif' => 'nif',
                'calle' => 'calle',
                'numero' => 1,
                'pisoLetra' => 'piso',
                'cp' => 'cp',
                'ciudad' => 'ciudad',
                'provincia' => 'provincia',
                'concepto' => 'concepto',
                'precio' => 21.21,
                'iva' => 21.21,
                'total' => 21.21,
                'state' => 0
            );

            $invoice  = new Factura($data);
            echo "<br />";
            echo $invoice->getNombre();
            $invoice->save();
            echo "<br />";

            $invoices = $invoice->getFacturasByCustomerId("44608");
            echo "<pre>";
            var_dump($invoices);
            echo "<pre>";

            $invoices = $invoice->getFacturasByTrimestreFilteredPaged(1, "2021", 0, 4);
            echo "<pre>";
            var_dump($invoices);
            echo "<pre>";




            echo "<h1>Dieta TEST</h1>";

            $data = array(
                'id' => null,
                'cliente' => 1,
                'nif' => 'nif',
                'tipo' => 0,
                'fecha' => '2022-01-20',
                'parametros' => 'parametros',
                'state' => 0,
                'order' => 'order',
                'enviado' => 0,
                'opc' => 0,
                'recordar' => 0,
                'tipoDieta' => 0,
                'nuevoModelo' => 0
            );

            $diet  = new Dieta($data);
            echo "<br />";
            echo $diet->getOrder();
            $diet->save();
            echo "<br />";

            $diets = $diet->getDietsByCustomerId("44608");
            echo "<pre>";
            var_dump($diets);
            echo "<pre>";

            $output = ob_get_clean();

            return $output;
        }

        function shortcode_invoices_online($atts = [], $content = null, $tag = '')
        {
            AleaCRMInvoice::invoicePages(0);
        }
        function shortcode_invoices_physical($atts = [], $content = null, $tag = '')
        {
            AleaCRMInvoice::invoicePages(1);
        }
        function shortcode_invoice($atts = [], $content = null, $tag = '')
        {
            AleaCRMInvoice::invoiceNew();
        }
        function shortcode_diets($atts = [], $content = null, $tag = '')
        {
            AleaCRMDiet::dietPages();
        }
        function shortcode_request($atts = [], $content = null, $tag = '')
        {
            AleaCRMRequest::requestPages();
        }
        function shortcode_export($atts = [], $content = null, $tag = '')
        {
            AleaExportXLS::exportPage();
        }
        function shortcode_start($atts = [], $content = null, $tag = '')
        {
            AleaSurvey::startSurveyApply();
        }
        function shortcode_continue($atts = [], $content = null, $tag = '')
        {
            AleaSurvey::continueSurveyApply();
        }

    } //EOC
}// namespace