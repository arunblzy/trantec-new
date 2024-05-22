<?php

namespace App\Http\Controllers\Api;

use App\Exports\SuppliersExport;
use App\Http\Controllers\Controller;
use App\Jobs\ImportSuppliersJob;
use App\Models\SupplierContact;
use App\Services\SupplierService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Supplier\StoreRequest as SupplierStoreRequest;
use App\Http\Requests\Supplier\UpdateRequest as SupplierUpdateRequest;
use App\Imports\SuppliersImport;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

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
        SupplierContact::where('supplier_id',$supplier->id)->delete();
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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        // Store the uploaded file in the storage
        $filePath = $request->file('file')->store('uploads', 'public');

        Log::info('File uploaded and stored at path: ' . $filePath);

        ImportSuppliersJob::dispatch($filePath);
        return response()->json([
            'message' => 'Import in-progress Successfully',
            'status' => true,
        ]);
    }

    public function downloadSample()
    {
        $fileName = 'suppliers_sample.xlsx';
        Excel::store(new SuppliersExport, $fileName, 'public');

        return response()->json([
            'url' => Storage::disk('public')->url($fileName)
        ]);
    }
}
