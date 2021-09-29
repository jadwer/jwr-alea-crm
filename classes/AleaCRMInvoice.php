<?php

namespace JWR;

class AleaCRMInvoice
{
    public static function createInvoicePages()
    {
        Utils::createPage("Alea CRM Online Invoice", "alea-invoice-online", "jwr-alea-crm-invoice-online-id");
        Utils::createPage("Alea CRM Physical Invoice", "alea-invoice-physical", "jwr-alea-crm-invoice-physical-id");
        Utils::createPage("Alea CRM New Invoice", "alea-invoice-new", "jwr-alea-crm-invoice-new-id");
        Utils::createPage("Alea CRM Edit Invoice", "alea-invoice-edit", "jwr-alea-crm-invoice-edit-id");
    }
    public static function deleteInvoicePages()
    {
        Utils::deletePage("jwr-alea-crm-invoice-online-id");
        Utils::deletePage("jwr-alea-crm-invoice-physical-id");
        Utils::deletePage("jwr-alea-crm-invoice-new-id");
        Utils::deletePage("jwr-alea-crm-invoice-edit-id");
    }
} // EOC