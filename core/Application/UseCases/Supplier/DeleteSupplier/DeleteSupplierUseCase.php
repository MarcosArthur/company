<?php


namespace Core\Application\UseCases\Supplier\DeleteSupplier;
use Core\Application\UseCases\Supplier\DeleteSupplier\DTO\SupplierDeleteInputDTO;
use Core\Domain\Supplier\Repository\SupplierRepositoryInterface;


class DeleteSupplierUseCase {

    private $input;
    private $repository;

    public function __construct(SupplierDeleteInputDTO $input, SupplierRepositoryInterface $repository) {
        $this->input = $input;
        $this->repository = $repository;
    }

    public function handle()
    {
        $data = $this->input->getData();

        return $this->repository->destroy($data['id']);
    }

}