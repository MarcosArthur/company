<?php

namespace Core\Application\UseCases\Company\CreateCompany\DTO;

use Core\Shared\InteractorDTO;

class CompanyCreateOutputDTO extends InteractorDTO {

  
    public $uf;
    public $name;
    public $document;
    public $id;

    public function __construct($uf, $name, $document, $id) {
        $this->uf = $uf;
        $this->name = $name;
        $this->document = $document;
        $this->id = $id;
    }
}