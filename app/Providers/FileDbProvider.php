<?php

namespace App\Providers;
use App\Product;
use Illuminate\Support\ServiceProvider;

class FileDbProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Product::saved(function ($p) {
            $this->updateFileDB();
        });

        Product::deleted(function ($p) {
            $this->updateFileDB();
        });
    }

    public function updateFileDB()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        file_put_contents(storage_path(). '/db.json', $products->toJson());
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
