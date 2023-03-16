<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Core\Domain\Company\Repository\CompanyRepositoryInterface',
            'Core\Infraestructure\Repository\Company\CompanyEloquentRepository'
        );
        

        $this->app->bind(
            'Core\Domain\Supplier\Repository\SupplierRepositoryInterface',
            'Core\Infraestructure\Repository\Supplier\SupplierEloquentRepository'
        );        
        
        $this->app->bind(
            'Core\Domain\Phone\Repository\PhoneRepositoryInterface',
            'Core\Infraestructure\Repository\Phone\PhoneEnloquentRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
