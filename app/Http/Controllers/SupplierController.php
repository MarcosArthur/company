<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\Company;
use Core\Domain\Company\Repository\CompanyRepositoryInterface;
use Core\Domain\Supplier\Repository\SupplierRepositoryInterface;


class SupplierController extends Controller
{

    public function suppliers($company_id, CompanyRepositoryInterface $companyRepositoryInterface, SupplierRepositoryInterface $supplierRepositoryInterface) 
    {
        $company = $companyRepositoryInterface->findOrFail($company_id);
        $data['suppliers'] = $supplierRepositoryInterface->getSuppliersByCompanyId($company_id);
        $data['company_id'] = $company_id;
        return view('supplier', $data);
    }
}
