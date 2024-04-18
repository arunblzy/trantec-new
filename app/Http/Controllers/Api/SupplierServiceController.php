<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SupplierContact;
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
        $validatedData = self::formatParams($validatedData);
        $supplier = $this->supplierService->create($validatedData);
        $supplier->vendorCategories()->sync(array_values($vendorCategoryArray));
        $contactData = self::formatContactData($validatedData,$supplier->id);
        SupplierContact::insert($contactData);

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
        $validatedData = self::formatParams($validatedData);
        $supplier = $this->supplierService->update($id,$validatedData);
        $supplier->vendorCategories()->sync(array_values($vendorCategoryArray));
        $contactData = self::formatContactData($validatedData,$supplier->id);
        SupplierContact::where('id',$supplier->id)->delete();
        SupplierContact::insert($contactData);

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

    private static function formatParams(array $validatedData) : array
    {
        $validatedData['country_id'] = $validatedData['country'];
        $validatedData['state_id'] = $validatedData['state'];
        $validatedData['city_id'] = $validatedData['city'];
        unset($validatedData['vendor_category'], $validatedData['country'], $validatedData['state'], $validatedData['city']);
        return $validatedData;
    }

    private static function formatContactData(array $validatedData, int $supplierId) : array
    {
        $contactData = [];
        $length = count($validatedData['contact_description']); // or count($validatedData['contact_phone']) //
        // etc
        for ($i = 0; $i < $length; $i++) {
            $contactData[] = [
                'supplier_id' => $supplierId,
                'description' => $validatedData['contact_description'][$i],
                'phone' => $validatedData['contact_phone'][$i],
                'mobile' => $validatedData['contact_mobile'][$i],
                'email' => $validatedData['contact_email'][$i],
                'fax' => $validatedData['contact_fax'][$i],
            ];
        }
        return $contactData;
    }
}
