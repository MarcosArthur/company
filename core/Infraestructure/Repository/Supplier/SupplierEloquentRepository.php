<?php

namespace Core\infraestructure\Repository\Supplier;

use Core\Domain\Supplier\Repository\SupplierRepositoryInterface;

use App\Models\Supplier;

class SupplierEloquentRepository implements SupplierRepositoryInterface
{

    private $model;

    public function __construct()
    {
        $this->model = new Supplier();
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    public function getSuppliersByCompanyId($company_id)
    {
        return $this->model->where('company_id', '=', $company_id)->get();
    }

    public function find($id)
    {
        return $this->model->with('phones')->find($id);
    }
}
