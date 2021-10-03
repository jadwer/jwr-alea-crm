<?php

namespace JWR\Alea {
    class AleaCRMInvoice
    {
        public static function createInvoicePages()
        {
            Utils::createPage("Alea CRM Online Invoice", "online-invoices", "alea-invoice-online", "jwr-alea-crm-invoice-online-id");
            Utils::createPage("Alea CRM Physical Invoice", "physical-invoices", "alea-invoice-physical", "jwr-alea-crm-invoice-physical-id");
            Utils::createPage("Alea CRM New Invoice", "invoice", "alea-invoice-new", "jwr-alea-crm-invoice-new-id");
        }
        public static function deleteInvoicePages()
        {
            Utils::deletePage("jwr-alea-crm-invoice-online-id");
            Utils::deletePage("jwr-alea-crm-invoice-physical-id");
            Utils::deletePage("jwr-alea-crm-invoice-new-id");
        }

        public static function invoicePages($state)
        {
            ob_start();

            if (isset($_GET['customer']) && $_GET['customer'] != '') { // p.e. 44608
                $customer = UTILS::escape($_GET['customer']);
                SELF::listInvoicesPerCusomer($customer);
            } else if (isset($_GET['invoice']) && $_GET['invoice'] != '') { // 27163
                $invoice_id = UTILS::escape($_GET['invoice']);

                SELF::showInvoice($invoice_id);
            } else if (isset($_GET['edit']) && $_GET['edit'] != '') { // 27163
                $invoice_id = UTILS::escape($_GET['edit']);

                SELF::editInvoice($invoice_id);
            } else {

                $page = (!isset($_GET['pag'])) ? 1 : Utils::escape($_GET['pag']);
                SELF::listInvoices($state, $page);
            }
        }

        private static function listInvoices($state,$page)
        {
            global $wp_query;
            $invoice  = new Factura();

            $invoices = $invoice->getFacturasByTrimestreFilteredPaged(1, "2021", $state, $page);
            echo "<pre>";
            var_dump($invoices);
            echo "<pre>";
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