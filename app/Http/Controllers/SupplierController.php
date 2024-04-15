<?php

namespace App\Http\Controllers;

use App\Constants\Constants;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SupplierController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $allSuppliersUrl = url(Constants::ALL_SUPPLIERS_URL);
        $deleteBaseUrl = url(Constants::SERVICE_BASE_URL);
        $appendQueryString = Constants::APPEND_SUPPLIERS_QUERY_STRING;
        return view('pages.suppliers.index', compact('allSuppliersUrl', 'deleteBaseUrl', 'appendQueryString'));
    }

    /**
     * @return View
     */
    public function create() : View
    {
        $storeUrl = url(Constants::STORE_SUPPLIER_URL);
        return view('pages.suppliers.create', compact('storeUrl'));
    }

    /**
     * @param Supplier $supplier
     * @return View
     */
    public function edit(Supplier $supplier) : View
    {
        $supplierUpdateUrl = url(Constants::SERVICE_BASE_URL.'/'.$supplier->id.'?tag=suppliers');
        return view('pages.suppliers.edit', compact('supplier', 'supplierUpdateUrl'));
    }

    public function generateCode(Request $request)
    {
        $name = $request['name'];
        $shortCode = strtoupper(substr(str_replace(' ', '', $name), 0, 2));
        $count = Supplier::where('name', 'like', $name)->count();
        $serialNo = $count + 1;
        $code = 'S/' . $shortCode . '-' . $serialNo;

        return response()->json(['code' => $code]);
    }
}
