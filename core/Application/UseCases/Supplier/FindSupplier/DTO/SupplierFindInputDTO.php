<?php

namespace Core\Application\UseCases\Supplier\FindSupplier\DTO;

use Core\Shared\InteractorDTO;

class SupplierFindInputDTO extends InteractorDTO
{

    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}
