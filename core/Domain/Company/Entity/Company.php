<?php

namespace Core\Domain\Company\Entity;
use Core\Shared\ValidateDocuments;

use \Exception;

class Company {

    use ValidateDocuments;

    private $uf;
    private $name;
    private $document;
    private $states;
    const STATES = ['PR', 'SC', 'RS', 'ES', 'RJ', 'MG', 'SP', 'GO', 'DF', 'FN', 'BA', 'SE', 'AL', 'PE', 'RN', 'PB', 'MA', 'CE', 'PI', 'TO', 'PA', 'AP', 'MT', 'MS','RR', 'RO', 'AM', 'AC' ];

    public function __construct($uf, $name, $document) 
    {
        $this->uf = $uf;
        $this->name = $name;
        $this->document = $document;
    }

    public function validate() 
    {
        if (!$this->uf) throw new Exception("the uf field cannot be empty");

        if (!in_array($this->uf, self::STATES)) throw new Exception("the uf field not find");

        if (!$this->name) throw new Exception("the company name field cannot be empty");
        
        if (!$this->document) throw new Exception("the cnpj field cannot be empty");
        
        if (!$this->validateCnpj()) throw new Exception("the cnpj invalid");
    }

}