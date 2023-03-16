<?php

namespace Core\infraestructure\Repository\Phone;

use App\Models\Company;
use App\Models\Phone;
use App\Models\Supplier;
use Core\Domain\Phone\Repository\PhoneRepositoryInterface;

class PhoneEnloquentRepository implements PhoneRepositoryInterface
{
    private $model;
    private $modelSupplier;

    public function __construct()
    {
        $this->model = new Phone();
        $this->modelSupplier = new Supplier();
    }

    public function create($data) 
    {
        $modelSupplier = $this->modelSupplier->find($data['supplier']);
  
        $modelSupplier->phones()->createMany($data['phones']);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}