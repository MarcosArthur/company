<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Core\Domain\Supplier\Repository\SupplierRepositoryInterface;

use Core\Application\UseCases\Supplier\DeleteSupplier\DTO\SupplierDeleteInputDTO;
use Core\Application\UseCases\Supplier\DeleteSupplier\DeleteSupplierUseCase;
use Core\Application\UseCases\Supplier\CreateSupplier\DTO\SupplierCreateInputDTO;
use Core\Application\UseCases\Supplier\FindSupplier\DTO\SupplierFindInputDTO;
use Core\Application\UseCases\Supplier\CreateSupplier\CreateSupplierUseCase;
use Core\Application\UseCases\Supplier\FindSupplier\FindSupplierUseCase;
use Core\Domain\Company\Repository\CompanyRepositoryInterface;
use Core\Domain\Phone\Repository\PhoneRepositoryInterface;


class SupplierController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CompanyRepositoryInterface $companyRepositoryInterface, SupplierRepositoryInterface $supplierRepositoryInterface, PhoneRepositoryInterface $phoneRepositoryInterface)
    {

        try {
            $company = $companyRepositoryInterface->find($request->company_id);

            $input = new SupplierCreateInputDTO($company->id, $company->uf, $request->name, $request->document, $request->document_type, $request->rg,  $request->birt_date, json_decode($request->phones, true));

            $supplierUseCase = new CreateSupplierUseCase($input, $supplierRepositoryInterface, $phoneRepositoryInterface);
            $result = $supplierUseCase->handle();
            return response()->json([
                'success' => [
                    'message' => 'supplier created sucessfull',
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, SupplierRepositoryInterface $supplierRepositoryInterface)
    {
        try {

            $input = new SupplierFindInputDTO($id);
            $findSupplierUseCase = new FindSupplierUseCase($input, $supplierRepositoryInterface);
            $result = $findSupplierUseCase->handle();

            return response()->json([
                'success' => [
                    'message' => 'supplier find sucessfull'
                ],
                'data' => [
                    'supplier' => $result
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, SupplierRepositoryInterface $supplierRepositoryInterface)
    {
        try {
            $input = new SupplierDeleteInputDTO($id);

            $supplierUseCase = new DeleteSupplierUseCase($input, $supplierRepositoryInterface);

            $supplierResponse = $supplierUseCase->handle();

            return response()->json([
                'success' => [
                    'message' => 'supplier delete sucessfull'
                ],
                'data' => [
                    'supplier' => $supplierResponse
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
