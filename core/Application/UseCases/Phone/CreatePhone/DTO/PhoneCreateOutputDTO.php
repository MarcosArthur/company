<?php

namespace Core\Application\UseCases\Phone\CreatePhone\DTO;

use Core\Shared\InteractorDTO;

class PhoneCreateOutputDTO extends InteractorDTO
{

    public $phones;

    public function __construct($phones)
    {
        $this->phones = $phones;
    }
}
