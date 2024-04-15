<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\SupplierService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Supplier\StoreRequest as SupplierStoreRequest;
use App\Http\Requests\Supplier\UpdateRequest as SupplierUpdateRequest;

class SupplierServiceController extends Controller
{
    protected SupplierService $supplierService;

    public function __construct(
        SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        return $this->supplierService->all($request);
    }

    /**
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate((new SupplierStoreRequest)->rules());
        $vendorCategoryArray = $validatedData['vendor_category'];
        unset($validatedData['vendor_category']);
        $supplier = $this->supplierService->create($validatedData);
        $supplier->vendorCategories()->sync(array_values($vendorCategoryArray));
        return $supplier;
    }

    /**
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request,int $id)
    {
        $validatedData = $request->validate((new SupplierUpdateRequest)->rules());
        $vendorCategoryArray = $validatedData['vendor_category'];
        unset($validatedData['vendor_category']);
        $supplier = $this->supplierService->update($id,$validatedData);
        $supplier->vendorCategories()->sync($vendorCategoryArray);
        return $supplier;
    }

    /**
     * @param Request $request
     * @param int $id
     * @return bool|null
     */
    public function destroy(Request $request, int $id) : null|bool
    {
        return $this->supplierService->delete($id);
    }
}
