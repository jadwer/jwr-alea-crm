<?php

namespace JWR;

class AleaCRMInvoice
{
    public static function createInvoicePages()
    {
        Utils::createPage("Alea CRM Online Invoice", "online-invoices", "alea-invoice-online", "jwr-alea-crm-invoice-online-id");
        Utils::createPage("Alea CRM Physical Invoice", "phisical-invoices", "alea-invoice-physical", "jwr-alea-crm-invoice-physical-id");
        Utils::createPage("Alea CRM New Invoice", "invoice", "alea-invoice-new", "jwr-alea-crm-invoice-new-id");
    }
    public static function deleteInvoicePages()
    {
        Utils::deletePage("jwr-alea-crm-invoice-online-id");
        Utils::deletePage("jwr-alea-crm-invoice-physical-id");
        Utils::deletePage("jwr-alea-crm-invoice-new-id");
    }
} // EOC