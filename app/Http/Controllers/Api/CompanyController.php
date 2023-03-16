<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use Core\Application\UseCases\Company\CreateCompany\DTO\CompanyCreateInputDTO;
use Core\Application\UseCases\Company\CreateCompany\CreateCompanyUseCase;
use Core\Domain\Company\Repository\CompanyRepositoryInterface;

class CompanyController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CompanyRequest  $request
     * @param  \Core\Domain\Company\Repository\CompanyRepositoryInterface  $companyRepositoryInterface
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CompanyRequest $request, CompanyRepositoryInterface $companyRepositoryInterface)
    {
        try {
            $companyData = new CompanyCreateInputDTO($request->uf, $request->name, $request->document);
            $companyUseCase = new CreateCompanyUseCase($companyData, $companyRepositoryInterface);
            $result = $companyUseCase->handle();

            return response()->json([
                'success' => [
                    'message' => 'Company created sucessfull',
                    'data' => $result
                ]
            ]);
        } catch (\Exception $exception) {
            return response()
                ->json([
                    'errors' => [
                        'error' => $exception->getMessage()
                    ]
                ]);
        }
    }
}
