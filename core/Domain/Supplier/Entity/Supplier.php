<?php

namespace Core\Domain\Supplier\Entity;

use \Exception;
use Core\Shared\ValidateDocuments;

class Supplier
{

    use ValidateDocuments;
    
    private $companyId;
    private $companyUf;
    private $name;
    private $document;
    private $document_type;
    private $rg;
    private $birtDate;
    private $phones;

    const UF_VALIDATE = ['PR'];

    const AGE_MINOR = 17;

    const DOCUMENT_TYPE_VALIDADE = ['physical'];


    public function __construct($companyId, $companyUf, $name, $document, $document_type, $rg, $birtDate, $phones)
    {
        $this->companyId = $companyId;
        $this->companyUf = $companyUf;
        $this->name = $name;
        $this->document = $document;
        $this->document_type = $document_type;
        $this->rg = $rg;
        $this->birtDate = $birtDate;
    }


    public function validate()
    {

        if (!$this->companyId) throw new Exception("the company has not been defined");

        if (!$this->name) throw new Exception("the name supplier has not been defined");

        if (!$this->document) throw new Exception("the document is empty");

        if (!$this->document_type) throw new Exception("the document type has not been defined");

        if (!$this->validateDocumentType()) throw new Exception("Document is invalid");

        if ($this->isPersonPhysical()) {
            if (!$this->birtDate) throw new Exception("the birt date type has not been defined");
            if (!$this->rg) throw new Exception("the rg has not been defined");
        }

        if ($this->validadeCompanyUf() && $this->isMinor() && $this->isPersonPhysical()) throw new Exception("It is not possible to register minors in the individual no state  {$this->companyUf}");
    }

    private function isMinor() 
    {
        $dateNow = new \DateTime("now");

        return ((new \DateTime($this->birtDate))->diff($dateNow)->y) <= $this::AGE_MINOR;
    }

    private function validadeCompanyUf() 
    {
        return in_array($this->companyUf, $this::UF_VALIDATE);
    }

    public function isPersonPhysical()
    {
        return in_array($this->document_type, $this::DOCUMENT_TYPE_VALIDADE);
    }
}
