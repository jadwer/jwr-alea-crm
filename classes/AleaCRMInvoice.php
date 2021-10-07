<?php

namespace JWR\Alea {

    class AleaCRMInvoice
    {
        public static function createInvoicePages()
        {
            Utils::createPage("Alea CRM Online Invoice", "online-invoices", "alea-invoice-online", "jwr-alea-crm-invoice-online-id", "templates/page-crm.php");
            Utils::createPage("Alea CRM Physical Invoice", "physical-invoices", "alea-invoice-physical", "jwr-alea-crm-invoice-physical-id", "templates/page-crm.php");
            Utils::createPage("Alea CRM New Invoice", "new-invoice", "alea-invoice-new", "jwr-alea-crm-invoice-new-id", "templates/page-crm.php");
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


        public static function invoiceNew()
        {
            $msg = "";
            if (isset($_POST['submit']) && $_POST['submit'] == 'send') {
                $invoice = new Factura();


                $invoice->setId((int)UTILS::escape($_POST['id_invoice']));
                $invoice->setReferencia(UTILS::escape($_POST['invoice_number']));
                $invoice->setFecha(UTILS::escape($_POST['date']));
                $invoice->setNombre(UTILS::escape($_POST['fname']));
                $invoice->setApellidos(UTILS::escape($_POST['last_name']));
                $invoice->setNif(UTILS::escape($_POST['nif_number']));
                $invoice->setCalle(UTILS::escape($_POST['address']));
                $invoice->setConcepto(UTILS::escape($_POST['concepto']));
                $invoice->setPrecio(UTILS::escape($_POST['price']));
                $invoice->setTotal(UTILS::escape($_POST['price']));
                $invoice->setState(UTILS::escape($_POST['state_invoice']));

                $invoice->save();
                $msg = "Factura guardada exitosamente";
            }

            SELF::newInvoice($msg);
        }

        private static function editInvoice($invoice_id)
        {
            $invoice = new Factura();
            $costumer_invoice = $invoice->getFacturaById($invoice_id);

            $msg = "";
            if (isset($_POST['submit']) && $_POST['submit'] == 'send') {

                $costumer_invoice->setId((int)UTILS::escape($_POST['id_invoice']));
                $costumer_invoice->setReferencia(UTILS::escape($_POST['invoice_number']));
                $costumer_invoice->setFecha(UTILS::escape($_POST['date']));
                $costumer_invoice->setNombre(UTILS::escape($_POST['fname']));
                $costumer_invoice->setApellidos(UTILS::escape($_POST['last_name']));
                $costumer_invoice->setNif(UTILS::escape($_POST['nif_number']));
                $costumer_invoice->setCalle(UTILS::escape($_POST['address']));
                $costumer_invoice->setConcepto(UTILS::escape($_POST['concepto']));
                $costumer_invoice->setPrecio(UTILS::escape($_POST['price']));
                $costumer_invoice->setTotal(UTILS::escape($_POST['price']));
                $costumer_invoice->setState(UTILS::escape($_POST['state_invoice']));

                $costumer_invoice->save();
                $msg = "Factura guardada exitosamente";
            }

            SELF::invoiceForm($costumer_invoice, $msg);
        }

        private static function paginator($pag, $period, $year, $state)
        {
            global $wp;
            $data = Factura::paginatorData($period, $year, $state);
?>
            <div class="flex justify-center space-x-8">
                <a href="<?= home_url($wp->request) . '/?pag=1&period=' . $period . '&year_selected=' . $year; ?>">
                    <div>
                        << </div>
                </a>
                <?php for ($i = 1; $i <= $data['num_pags']; $i++) : ?>
                    <a href="<?= home_url($wp->request) . '/?pag=' . $i . '&period=' . $period . '&year_selected=' . $year; ?>" class=" <?php echo ($pag == $i) ? 'selected' : ''; ?>">
                        <div><?= $i; ?></div>
                    </a>
                <?php endfor; ?>
                <a href="<?= home_url($wp->request) . '/?pag=' . $data['num_pags'] . '&period=' . $period . '&year_selected=' . $year; ?>">
                    <div> >> </div>
                </a>
            </div>
            <div class="flex justify-center text-center">
                <?= $data['total']; ?> registros en el trimestre.
            </div>
        <?php

        }
        private static function newInvoice($msg)
        {
            $invoice = new Factura;
            $invoice->setFecha(date("Y-m-d H:i:s"));
            $invoice->setState(1);
            SELF::invoiceForm($invoice, $msg);
        }

        private static function invoiceForm($invoice, $msg)
        {
            global $wp;
        ?>
            <div class="container">
                <div class=""><?= $msg ?></div>
                <form id="facturas" action="" method="post" class="" enctype="multipart/form-data">
                    <input type="hidden" name="id_invoice" value="<?= $invoice->getId() ?>">
                    <input type="hidden" name="state_invoice" value="<?= $invoice->getState() ?>">

                    <div class="">
                        <div class="">
                            <label>Número de factura</label>
                            <input type="text" required name="invoice_number" id="invoice_number" value="<?= $invoice->getReferencia() ?>" class="" />
                        </div>

                        <div class="">
                            <div class="">
                                <label>Fecha *</label>
                                <input type="text" id="datepicker" name="date" value="<?= $invoice->getFecha() ?>" class="input-medium" required="required" autocomplete="off" />
                            </div>

                            <div class="">
                                <label>Nombre *</label>
                                <input type="text" name="fname" id="fname" value="<?= $invoice->getNombre() ?>" class="" required="required" />
                            </div>
                            <div class="">
                                <label>Apellidos *</label>
                                <input type="text" name="last_name" id="last_name" value="<?= $invoice->getApellidos() ?>" class="" required="required" />
                            </div>
                            <div class="">
                                <label>NIF *</label>
                                <input type="text" name="nif_number" id="nif_number" value="<?= $invoice->getNif() ?>" class=" required" required="required" />
                            </div>
                        </div>
                        <div class="">
                            <label class="required">Dirección *</label>
                            <input type="text" name="address" id="address" value="<?= $invoice->getDireccion() ?>" class=" required" required="required">
                        </div>
                        <div class="">
                            <label>Concepto</label>
                            <input type="text" name="concepto" id="concepto" value="<?= $invoice->getConcepto() ?>" class="" size="50" />
                        </div>
                        <div class="">
                            <label>Precio *</label>
                            <input type="text" name="price" id="price" value="<?= $invoice->getPrecio() ?>" class=" required" required="required" />
                        </div>

                        <div class="">
                            <button type="submit" name="submit" value="send" class="">Guardar</button>
                            <a class="" href="<?= home_url('request') ?>" title="Cancel">Regresar</a>
                        </div>
                    </div>

                </form>
            </div>
        <?php
        }

        private static function listInvoices($state, $page)
        {
            $year_selected = (get_query_var('year_selected')) ? get_query_var('year_selected') : "2021";
            $period = (get_query_var('period')) ? get_query_var('period') : 1;

            global $wp_query;
            global $wp;
            $invoice = new Factura();

            $invoices = $invoice->getFacturasByTrimestreFilteredPaged($period, $year_selected, $state, $page);
            $years = $invoice->getInvoicesYears();

        ?>
            <form target="_blank" action="<?= home_url('export') ?>" method="post">
                <div class="flex justify-around bg-gray-100 rounded-2xl shadow-md mb-8">

                    <input type="hidden" name="type" value="<?= $state; ?>" />
                    <div class="flex space-x-8">
                        <div>
                            <?php if ($state == 1) : ?>
                                <a href="<?= home_url('new-invoice'); ?>" class="flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    <spam>
                                        Añadir
                                    </spam>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div>
                            <button class="flex" type="submit" name="export" value="true">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                <span>
                                    Exportar
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="flex space-x-8">
                        <select name="period" id="period" onChange="updatePage()">
                            <option value="1" <?php echo ($period == 1) ? 'selected="selected"' : ''; ?>>Primer trimestre</option>
                            <option value="2" <?php echo ($period == 2) ? 'selected="selected"' : ''; ?>>Segundo trimestre</option>
                            <option value="3" <?php echo ($period == 3) ? 'selected="selected"' : ''; ?>>Tercer trimestre</option>
                            <option value="4" <?php echo ($period == 4) ? 'selected="selected"' : ''; ?>>Cuarto trimestre</option>
                        </select>

                        <select name="anio" id="anio" onChange="updatePage()">
                            <?php foreach ($years as $year) : ?>
                                <option vaule="$year->year" <?php echo ($year_selected == $year->year) ? 'selected="selected"' : ''; ?>><?= $year->year; ?></option>
                            <?php endforeach; ?>
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

            <?php SELF::paginator($page, $period, $year_selected, $state); ?>

            <div class="flex justify-around bg-gray-100 rounded-2xl shadow-md mt-8">
                <div class="">
                    Total base: <?= $invoice->getBaseByTrimestre($period, $year_selected, $state); ?>

                </div>
                <div class="">
                    IVA <?= $invoice->getIVAByTrimestre($period, $year_selected, $state); ?>
                </div>
                <div class="">
                    Total <?= $invoice->getTotalByTrimestre($period, $year_selected, $state); ?>
                </div>
            </div>
            <script type="text/javascript">
                var siteurl = '<?php echo site_url(); ?>';

                function updatePage() {
                    var anio = document.getElementById('anio').value;
                    var period = document.getElementById('period').value;

                    window.location = '<?= home_url($wp->request); ?>/?period=' + period + '&year_selected=' + anio
                }

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
            $invoice = new Factura();


            $invoices = $invoice->getFacturasByCustomerId($customer);
            echo "<pre>";
            var_dump($invoices);
            echo "<pre>";
        }

        private static function showInvoice($invoice_id)
        {
            global $wp_query;
            $invoice = new Factura();

            $invoices = $invoice->getFacturaById($invoice_id);
            echo "<pre>";
            var_dump($invoices);
            echo "<pre>";
        }
    } // EOC
} // namespace