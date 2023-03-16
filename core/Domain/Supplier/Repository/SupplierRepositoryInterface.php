<?php

namespace Core\Domain\Supplier\Repository;

interface SupplierRepositoryInterface {

    public function create($data);

    public function destroy($id);

    public function find($id);

}