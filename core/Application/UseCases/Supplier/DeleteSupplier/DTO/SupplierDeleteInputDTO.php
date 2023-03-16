<?php

namespace Core\Application\UseCases\Supplier\DeleteSupplier\DTO;

use Core\Shared\InteractorDTO;

class SupplierDeleteInputDTO extends InteractorDTO{

    public $id;

    public function __construct($id) {
        $this->id = $id;
    }

}