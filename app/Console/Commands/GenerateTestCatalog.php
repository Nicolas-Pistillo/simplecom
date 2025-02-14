<?php

namespace App\Console\Commands;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Tenant;
use App\Services\FileService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GenerateTestCatalog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'simplecom:generate-catalog {--tenant=} {--extense}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Poblate the tenant catalog with test resources';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (empty($this->option('tenant'))) 
            return $this->error('No se proporcionó el nombre del tenant');

        $tenant = Tenant::where('name', $this->option('tenant'))->first();

        if (!$tenant || !$tenant instanceof Tenant)
            return $this->error('El tenant ' . $this->option('tenant') . ' no existe');

        tenancy()->initialize($tenant);

        $productCount = 0;

        $products = Http::get('https://fakestoreapi.com/products')->collect();

        if ($products->isEmpty()) return;

        $this->line("Generando catalogo en " . tenant('ecommerce_name') . '...');

        foreach($products as $product)
        {
            $productName = data_get($product, 'title');
            $categoryName = data_get($product, 'category');

            $category = Category::firstOrCreate(['name' => $categoryName]);

            $model = Product::firstOrCreate(['code' => data_get($product, 'id')],
            [
                'name'        => $productName,
                'published'   => true,
                'description' => data_get($product, 'description'),
                'price'       => data_get($product, 'price') * 100,
                'category_id' => $category->id,
                'stock'       => 50,
                'width'       => rand(5,15),
                'height'      => rand(5,15),
                'length'      => rand(5,15),
                'weight'      => rand(100,2000),
                'created_by'  => 1
            ]);

            if (empty($model->images()->count()))
            {
                $uploadedFile = FileService::getUploadedFileFromUrl(data_get($product, 'image'));

                if (!$uploadedFile) continue;

                $path = $uploadedFile->store($model->images_dir);

                ProductImage::create([
                    'product_id' => $model->id,
                    'url'        => $path,
                    'order'      => 1
                ]);
            }

            if ($model->wasRecentlyCreated) $productCount++;
        }

        /* $products = Http::get('https://api.escuelajs.co/api/v1/products')->collect();

        if ($products->isEmpty()) return;

        $this->line("Generando catalogo en " . tenant('ecommerce_name') . '...');

        foreach($products as $product)
        {
            $productName = data_get($product, 'title');
            $categoryName = data_get($product, 'category.name');

            if (!in_array($categoryName, ['Electronics', 'Miscellaneous', 'Shoes'])
            || in_array($productName, ['444', '555']))
            {
                continue;
            }

            $category = Category::firstOrCreate(['name' => $categoryName]);
            $categoryImage = data_get($product, 'category.image');

            if (empty($category->image_url) && !empty($categoryImage))
            {
                $uploadedFile = FileService::getUploadedFileFromUrl($categoryImage);

                $path = $uploadedFile->store(tenant('categories_url'));

                $category->update(['image_url' => $path]);
            }

            $model = Product::firstOrCreate(['code' => data_get($product, 'id')], 
            [
                'name'        => $productName,
                'published'   => true,
                'description' => data_get($product, 'description'),
                'price'       => data_get($product, 'price') * 100,
                'category_id' => $category->id,
                'stock'       => 50,
                'width'       => rand(5,29),
                'height'      => rand(5,29),
                'length'      => rand(5,29),
                'weight'      => rand(100,2000),
                'created_by'  => 1
            ]);

            if (empty($model->images()->count()))
            {
                foreach(data_get($product, 'images', []) as $index => $imageUrl)
                {
                    $uploadedFile = FileService::getUploadedFileFromUrl($imageUrl);

                    if (!$uploadedFile) continue;

                    $path = $uploadedFile->store($model->images_dir);

                    ProductImage::create([
                        'product_id' => $model->id,
                        'url'        => $path,
                        'order'      => $index + 1
                    ]);
                }
            }

            if ($model->wasRecentlyCreated) $productCount++;
        } */

        if($this->option('extense'))
        {
            $dummyJsonAvailable = Http::get('https://dummyjson.com/test')->json('status');

            if ($dummyJsonAvailable != 'ok') return;

            // Retrieved from DummyJSON Products API - https://dummyjson.com/docs/products
            $products = Http::get('https://dummyjson.com/products')->collect('products');

            if ($products->isEmpty()) return;

            foreach($products as $product)
            {
                $categoryName = ucfirst(data_get($product, 'category'));
                $brandName = ucfirst(data_get($product, 'brand'));

                $category = Category::firstOrCreate(['name' => $categoryName]);

                $brand = !empty($brandName) ? Brand::firstOrCreate(['name' => $brandName])
                                            : null;
                
                $model = Product::firstOrCreate(['code' => data_get($product, 'sku')], 
                [
                    'name'              => data_get($product, 'title'),
                    'published'         => true,
                    'description'       => data_get($product, 'description'),
                    'price'             => data_get($product, 'price') * 100,
                    'discount_percent'  => intval(data_get($product, 'discountPercentage', 0)),
                    'category_id'       => $category->id,
                    'brand_id'          => $brand?->id,
                    'stock'             => 50,
                    'width'             => data_get($product, 'dimensions.width'),
                    'height'            => data_get($product, 'dimensions.height'),
                    'length'            => data_get($product, 'dimensions.depth'),
                    'weight'            => data_get($product, 'weight'),
                    'created_by'        => 1
                ]);

                if (empty($model->images()->count()))
                {
                    foreach(data_get($product, 'images', []) as $index => $imageUrl)
                    {
                        $uploadedFile = FileService::getUploadedFileFromUrl($imageUrl);

                        $path = $uploadedFile->store($model->images_dir);

                        ProductImage::create([
                            'product_id' => $model->id,
                            'url'        => $path,
                            'order'      => $index + 1
                        ]);
                    }
                }

                if ($model->wasRecentlyCreated) $productCount++;
            }
        }

        return $this->line("Se agregaron $productCount productos a $tenant->ecommerce_name");
    }
}
