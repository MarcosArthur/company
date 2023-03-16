<?php

namespace Core\Application\UseCases\Phone\CreatePhone\DTO;

use Core\Shared\InteractorDTO;

class PhoneCreateInputDTO extends InteractorDTO
{

    public $phones;
    public $supplier;

    public function __construct($phones, $supplier)
    {
        $this->phones = $phones;
        $this->supplier = $supplier;
    }
}
