<?php
namespace App\Services;

use App\Models\Supplier;
use App\Repositories\SupplierRepositoryInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SupplierService implements SupplierRepositoryInterface
{
    public function all(Request $request)
    {
        $customers = Supplier::select('id', 'name', 'email', 'phone','address','created_at','updated_at')
            ->when($request->has('term'), function ($query) use ($request) {
                $query->whereAny([
                    'id',
                    'name',
                    'email',
                    'phone',
                ], 'LIKE', "%{$request->get('term')}%");
            });
        return DataTables::of($customers)->make(true);
    }

    public function create(array $data)
    {
        return Supplier::create($data);
    }

    public function find(int $id)
    {
        return Supplier::findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        $customer = $this->find($id);
        $customer->update($data);
        return $customer;
    }

    public function delete(int $id) : bool
    {
        return (bool) $this->find($id)->delete();
    }
}
