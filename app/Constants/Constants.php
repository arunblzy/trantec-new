<?php
namespace App\Constants;

class Constants {
    const SERVICE_BASE_URL = '/api/services';
    const SUPPLIERS_QUERY_STRING = 'suppliers';
    const APPEND_SUPPLIERS_QUERY_STRING = '?tag=suppliers';
    const APPEND_INVOICES_QUERY_STRING = '?tag=invoices';
    const ALL_SUPPLIERS_URL = '/api/suppliers';
    const STORE_SUPPLIER_URL = '/api/services?tag=suppliers';
    const ALL_INVOICES_URL = '/api/services?tag=invoices';
    const STORE_INVOICE_URL = '/api/services?tag=invoices';
}
