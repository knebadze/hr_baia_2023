<?php

namespace App\Providers;

use App\Services\ClassificatoryService;
use Illuminate\Support\ServiceProvider;

class FooterCategoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $service = new ClassificatoryService();

        // Get the 'category' data from the service
        $categoryData = $service->get(['category']);

        // Extract the 'category' array from the returned data
        $category = $categoryData['category'];

        // Share the $category variable with all views
        view()->share('category', $category);
    }
}
