<?php

namespace Core\Application\UseCases\Supplier\CreateSupplier;

use Core\Application\UseCases\Phone\CreatePhone\CreatePhoneUseCase;
use Core\Application\UseCases\Phone\CreatePhone\DTO\PhoneCreateInputDTO;
use Core\Domain\Supplier\Entity\Supplier;
use Core\Domain\Supplier\Repository\SupplierRepositoryInterface;
use Core\Application\UseCases\Supplier\CreateSupplier\DTO\{SupplierCreateOutputDTO, SupplierCreateInputDTO};
use Core\Domain\Phone\Repository\PhoneRepositoryInterface;
class CreateSupplierUseCase
{

    private $input;
    private $repository;
    private $phoneRespository;

    public function __construct(SupplierCreateInputDTO $input, SupplierRepositoryInterface $repository, PhoneRepositoryInterface $phoneRespository)
    {
        $this->input = $input;
        $this->repository = $repository;
        $this->phoneRespository = $phoneRespository;
    }


    public function handle(): SupplierCreateOutputDTO
    {

        $data = $this->input->getData();

        $supplier = new Supplier(
            $data['company_id'],
            $data['companyUf'],
            $data['name'],
            $data['document'],
            $data['document_type'],
            $data['rg'],
            $data['birt_date'],
            $data['phones']
        );

        $supplier->validate();

        $result = $this->repository->create($data);


        $inputPhone = new PhoneCreateInputDTO($data['phones'], $result->id);

        $phone = new CreatePhoneUseCase($inputPhone, $this->phoneRespository);

        $phone->handle();

        return new SupplierCreateOutputDTO(
            $result->company_id,
            $result->name,
            $result->document,
            $result->document_type,
            $result->rg,
            $result->birt_date
        );
    }
}
