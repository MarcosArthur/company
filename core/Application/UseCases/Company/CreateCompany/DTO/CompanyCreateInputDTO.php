<?php

namespace Core\Application\UseCases\Company\CreateCompany\DTO;

use Core\Shared\InteractorDTO;


class CompanyCreateInputDTO extends InteractorDTO {

    public $uf;
    public $name;
    public $document;


    public function __construct($uf, $name, $document) {
        $this->uf = $uf;
        $this->name = $name;
        $this->document = $document;
    }

}