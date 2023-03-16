<?php

namespace Core\Application\UseCases\Supplier\FindSupplier;

use Core\Application\UseCases\Supplier\FindSupplier\DTO\{SupplierFindInputDTO, SupplierFindOutputDTO};
use Core\Domain\Supplier\Repository\SupplierRepositoryInterface;
use Exception;

class FindSupplierUseCase
{

    private $respository;
    private $input;

    public function __construct(SupplierFindInputDTO $input, SupplierRepositoryInterface $respository)
    {
        $this->input = $input;
        $this->respository = $respository;
    }

    public function handle(): SupplierFindOutputDTO
    {
        $data = $this->input->getData();

        $supplier = $this->respository->find($data['id']);

        if (!$supplier) throw new Exception("Not find");

        return new SupplierFindOutputDTO(
            $supplier->name,
            $supplier->document,
            $supplier->document_type,
            $supplier->rg,
            $supplier->birt_date,
            $supplier->created_at,
            $supplier->updated_at,
            $supplier->phones
        );
    }
}
