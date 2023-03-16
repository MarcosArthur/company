<?php

namespace Core\Infraestructure\Repository\Company;

use Core\Domain\Company\Repository\CompanyRepositoryInterface;
use App\Models\Company;

class CompanyEloquentRepository implements CompanyRepositoryInterface {

    private $model;

    public function __construct() {
        $this->model = new Company();
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function simplePaginate($count)
    {
        return $this->model->simplePaginate($count);
    }

    public function findByCnpj($cnpj)
    {
        return $this->model->where('document', $cnpj)->first();
    }


}