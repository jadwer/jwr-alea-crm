<?php

namespace JWR\Alea {
    class AleaCRMInvoice
    {
        public static function createInvoicePages()
        {
            Utils::createPage("Alea CRM Online Invoice", "online-invoices", "alea-invoice-online", "jwr-alea-crm-invoice-online-id", "templates/page-crm.php");
            Utils::createPage("Alea CRM Physical Invoice", "physical-invoices", "alea-invoice-physical", "jwr-alea-crm-invoice-physical-id", "templates/page-crm.php");
            Utils::createPage("Alea CRM New Invoice", "invoice", "alea-invoice-new", "jwr-alea-crm-invoice-new-id", "templates/page-crm.php");
        }
        public static function deleteInvoicePages()
        {
            Utils::deletePage("jwr-alea-crm-invoice-online-id");
            Utils::deletePage("jwr-alea-crm-invoice-physical-id");
            Utils::deletePage("jwr-alea-crm-invoice-new-id");
        }

        public static function invoicePages($state)
        {
            if (isset($_GET['customer']) && $_GET['customer'] != '') {
                $customer = UTILS::escape($_GET['customer']);
                SELF::listInvoicesPerCusomer($customer);
            } else if (isset($_GET['invoice']) && $_GET['invoice'] != '') {
                $invoice_id = UTILS::escape($_GET['invoice']);

                SELF::showInvoice($invoice_id);
            } else if (isset($_GET['edit']) && $_GET['edit'] != '') {
                $invoice_id = UTILS::escape($_GET['edit']);

                SELF::editInvoice($invoice_id);
            } else {

                $page = (!isset($_GET['pag'])) ? 1 : Utils::escape($_GET['pag']);
                SELF::listInvoices($state, $page);
            }
        }


        private static function listInvoices($state, $page)
        {
            global $wp_query;
            global $wp;
            $invoice  = new Factura();

            $invoices = $invoice->getFacturasByTrimestreFilteredPaged(1, "2021", $state, $page);


?>
            <form target="_blank" action="<?=home_url('export')?>" method="post">
                <div class="flex justify-around bg-gray-100 rounded-2xl shadow-md mb-8">

                    <input type="hidden" name="type" value="<?= $state; ?>" />
                    <div class="flex space-x-8">
                        <div>
                            <a href="<?=home_url('invoice'); ?>" class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                <spam>
                                    Añadir
                                </spam>
                            </a>
                        </div>
                        <div>
                            <button class="flex" type="submit" name="export" value="true">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg> <span>
                                    Exportar
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="flex space-x-8">
                        <select name="period">
                            <option value="1" selected="selected">Primer trimestre</option>
                            <option value="2">Segundo trimestre</option>
                            <option value="3">Tercer trimestre</option>
                            <option value="4">Cuarto trimestre</option>
                        </select>

                        <select name="anio">
                            <option value="2021" selected="selected">2021</option>
                            <option value="2020">2020</option>
                            <option value="2019">2019</option>
                            <option value="2018">2018</option>
                        </select>

                    </div>
                </div>
            </form>

            <div class="container bg-gray-100 shadow-xl">
                <div class="flex justify-around text-center bg-red-400 rounded-lg text-gray-50">
                    <div class="w-1/12">Fecha</div>
                    <div class="w-1/12 justify-center">Nº De Factura</div>
                    <div class="w-3/12">Nombre Completo</div>
                    <div class="w-1/12">NIF</div>
                    <div class="w-2/12">Dirección</div>
                    <div class="w-1/12">Base</div>
                    <div class="w-1/12">IVA</div>
                    <div class="w-1/12">Total</div>
                    <div class="w-1/12"></div>
                </div>
                <?php foreach ($invoices as $customer_invoice) : ?>
                    <div class="container flex justify-around align-middle text-gray-800 text-xs">
                        <div class="w-1/12"><?= $customer_invoice->getFecha(); ?></div>
                        <div class="w-1/12 justify-center"><?= $customer_invoice->getReferencia(); ?></div>
                        <div class="w-3/12 text-center"><?= $customer_invoice->getNombre() . " " . $customer_invoice->getApellidos(); ?></div>
                        <div class="w-1/12"><?= $customer_invoice->getNif(); ?></div>
                        <div class="w-2/12"><?= $customer_invoice->getDireccion(); ?></div>
                        <div class="w-1/12"><?= $customer_invoice->getPrecio(); ?>€</div>
                        <div class="w-1/12"><?= $customer_invoice->getIVA(); ?>€</div>
                        <div class="w-1/12"><?= $customer_invoice->getTotal(); ?>€</div>
                        <div class="w-1/12">
                            <button class="printOption" onclick="printOption('<?= $customer_invoice->getId(); ?>')" data-id="<? $customer_invoice->getId(); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                </svg>
                            </button>
                            <button>
                                <a href="<?php echo home_url($wp->request) . "?edit=" . $customer_invoice->getId(); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                            </button>
                        </div>
                    </div>

                    <?php include(WP_PLUGIN_DIR . '/jwr-alea-crm/inc/invoice-print.php'); ?>
                <?php endforeach; ?>
            </div>

            <div class="flex justify-around bg-gray-100 rounded-2xl shadow-md mt-8">
                <div class="">
                    Total base
                </div>
                <div class="">
                    IVA
                </div>
                <div class="">
                    Total
                </div>
            </div>
            <script type="text/javascript">
                var siteurl = '<?php echo site_url(); ?>';

                function printOption(id) {
                    console.log(id);
                    var divToPrint = document.getElementById('DivIdToPrint' + id);

                    var newWin = window.open('', 'Print-Window');
                    newWin.document.open();
                    newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
                    newWin.document.close();
                    setTimeout(function() {
                        newWin.close();
                    }, 10);

                }
            </script>
<?php
        }

        private static function listInvoicesPerCusomer($customer)
        {
            global $wp_query;
            $invoice  = new Factura();


            $invoices = $invoice->getFacturasByCustomerId($customer);
            echo "<pre>";
            var_dump($invoices);
            echo "<pre>";
        }

        private static function showInvoice($invoice_id)
        {
            global $wp_query;
            $invoice  = new Factura();

            $invoices = $invoice->getFacturaById($invoice_id);
            echo "<pre>";
            var_dump($invoices);
            echo "<pre>";
        }

        private static function editInvoice($invoice_id)
        {
            global $wp_query;
            $invoice  = new Factura();

            $invoices = $invoice->getFacturaById($invoice_id);
            echo "<pre>";
            var_dump($invoices);
            echo "<pre>";
        }
    } // EOC
} // namespace