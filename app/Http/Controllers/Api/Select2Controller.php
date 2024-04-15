<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\Supplier;
use App\Models\VendorCategory;
use Illuminate\Http\JsonResponse;

class Select2Controller
{
    public function getData(string $table) : JsonResponse
    {
        $searchTerm = request('searchTerm');
        $id = request('id');
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
            case 'countries':
                $data = Country::select('id', 'name')
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

            case 'states':
                $data = State::select('id', 'name')->where('country_id', $id)
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

            case 'cities':
                $data = City::select('id', 'name')->where('state_id', $id)
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
