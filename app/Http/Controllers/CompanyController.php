<?php

namespace App\Http\Controllers;

use Core\Domain\Company\Repository\CompanyRepositoryInterface;

class CompanyController extends Controller
{
    const AMOUNT_OF_RECORD = 10;
   
    public function index(CompanyRepositoryInterface $companyRepositoryInterface)
    {
        $data['companies'] = $companyRepositoryInterface->simplePaginate(self::AMOUNT_OF_RECORD);
        return view('company', $data);
    }
}