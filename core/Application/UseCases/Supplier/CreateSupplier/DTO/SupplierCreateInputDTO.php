<?php

namespace Core\Application\UseCases\Supplier\CreateSupplier\DTO;
use Core\Shared\InteractorDTO;

class SupplierCreateInputDTO extends InteractorDTO {
 
    public $company_id;
    public $companyUf;
    public $name;
    public $document;
    public $document_type;
    public $rg;
    public $phones;
    public $birt_date;

    public function __construct($company_id, $companyUf, $name, $document, $document_type, $rg, $birt_date, $phones)
    {
        $this->company_id = $company_id;
        $this->companyUf = $companyUf;
        $this->name = $name;
        $this->document = $document;
        $this->document_type = $document_type;
        $this->rg = $rg;
        $this->phones = $phones;
        $this->birt_date = $birt_date;
    }

}