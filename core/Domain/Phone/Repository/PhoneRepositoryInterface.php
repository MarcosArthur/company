<?php

namespace Core\Domain\Phone\Repository;


interface PhoneRepositoryInterface {

    public function create($data);

    public function delete($id);

}