<?php

namespace Core\Domain\Company\Repository;

interface CompanyRepositoryInterface {

    public function create($data);

    public function find($id);

    public function findOrFail($id);

    public function simplePaginate($count);

    public function findByCnpj($cnpj);
}