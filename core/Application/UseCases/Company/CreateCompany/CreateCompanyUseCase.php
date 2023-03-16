<?php

namespace Core\Application\UseCases\Company\CreateCompany;

use Core\Application\UseCases\Company\CreateCompany\DTO\{CompanyCreateOutputDTO, CompanyCreateInputDTO};
use Core\Domain\Company\Entity\Company;
use Core\Domain\Company\Repository\CompanyRepositoryInterface;
use \Exception;

class CreateCompanyUseCase {

    private $input;
    private $repository;

    public function __construct(CompanyCreateInputDTO $input, CompanyRepositoryInterface $repository) {
        $this->input = $input;
        $this->repository = $repository;
    }

    public function handle() : CompanyCreateOutputDTO
    {

        $data = $this->input->getData();
 
        $company = new Company(
            $data['uf'],
            $data['name'],
            $data['document']
        );


        $company->validate();

        if ($this->repository->findByCnpj($data['document'])) throw new \Exception("cnpj is already created");

        $result = $this->repository->create($data);

        return new CompanyCreateOutputDTO(
            $result->uf,
            $result->name,
            $result->document,
            $result->id
        );

    }



}