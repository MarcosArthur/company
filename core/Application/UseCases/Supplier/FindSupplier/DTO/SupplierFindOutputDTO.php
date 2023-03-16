<?php

namespace Core\Application\UseCases\Supplier\FindSupplier\DTO;

use Core\Shared\InteractorDTO;

class SupplierFindOutputDTO extends InteractorDTO
{

    public $name;
    public $document;
    public $document_type;
    public $rg;
    public $birt_date;
    public $created_at;
    public $updated_at;
    public $phones = [];

    public function __construct($name, $document, $document_type, $rg, $birt_date, $created_at, $updated_at, $phones)
    {
        $this->name = $name;
        $this->document = $document;
        $this->document_type = $document_type;
        $this->rg = $rg;
        $this->birt_date = $birt_date;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->phones = $phones;
    }
}
