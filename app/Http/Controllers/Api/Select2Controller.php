<?php

namespace App\Http\Controllers\Api;

use App\Models\Supplier;
use App\Models\Invoice;
use App\Models\VendorCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rules\In;

class Select2Controller
{
    public function getData(string $table) : JsonResponse
    {
        $searchTerm = request('searchTerm');
        $results = [];
        switch ($table) {
            case 'suppliers':
                $data = Supplier::select('id', 'name')
                    ->when($searchTerm, function ($query) use ($searchTerm) {
                        $query->where('name', 'like', "%{$searchTerm}%");
                })->get();
                foreach ($data ?? [] as $item) {
                    $results[] = [
                        'id' => $item->id,
                        'text' => $item->name
                    ];
                }
                break;
            case 'vendor_categories':
                $data = VendorCategory::select('id', 'name')
                    ->when($searchTerm, function ($query) use ($searchTerm) {
                        $query->where('name', 'like', "%{$searchTerm}%");
                    })->get();
                foreach ($data ?? [] as $key => $item) {
                    $results[] = [
                        'id' => $item,
                        'text' => $item,
                    ];
                }
                break;
        }

        return response()->json(['data' => $results]);
    }
}
