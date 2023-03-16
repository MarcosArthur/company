<?php

namespace Core\Domain\Phone\Entity;

use \Exception;

class Phone {

    private $phones;
    private $supplier;

    public function __construct($phones, $supplier)
    {
        $this->phones = $phones;
        $this->supplier = $supplier;
    }

    public function validate()
    {

        if (!$this->supplier)throw new Exception("pow");
 
        if(!$this->phones) throw new Exception("all phones empty" . $this->phones);

        foreach ($this->phones as $phone) {
            
            if (!$phone['phone']) throw new Exception("set all input phones");

            if (!$this->isPhoneValid($phone['phone'])) throw new Exception("phone not valid " . $phone['phone']);

        }
    }

    private function isPhoneValid($phone)
    {
        if(preg_match("/\(?\d{2}\)?\s?\d{5}\-?\d{4}/", $phone)) {
            return true;
        }

        return false;
    }

}