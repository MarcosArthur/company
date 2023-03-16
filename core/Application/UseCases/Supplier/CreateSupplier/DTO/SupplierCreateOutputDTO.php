<?php

namespace Core\Application\UseCases\Supplier\CreateSupplier\DTO;
use Core\Shared\InteractorDTO;

class SupplierCreateOutputDTO extends InteractorDTO{
 
    public $company_id;
    public $name;
    public $document;
    public $document_type;
    public $rg;
    public $birt_date;

    public function __construct($companyId, $name, $document, $document_type, $rg, $birt_date)
    {
        $this->company_id = $companyId;
        $this->name = $name;
        $this->document = $document;
        $this->document_type = $document_type;
        $this->rg = $rg;
        $this->birt_date = $birt_date;
    }
    
    
}