<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCollection;
use App\Services\FaqsService;
use Illuminate\Http\Request;

class EcommerceController extends Controller
{
    public function index(Request $request)
    {
        return view('ecommerce.index', [
            'banners'             => Banner::published()->get(),
            'featuredProducts'    => Product::available()->featured()->with('category')->get()
        ]);
    }

    public function productDetail($productName, Product $product)
    {
        $product->load('images', 'category.father.father', 'brand', 'tags', 'variantOptions');

        return view('ecommerce.product-detail', compact('product'));
    }

    public function checkout()
    {
        return view('ecommerce.checkout');
    }

    public function contact(Request $request)
    {
        return view('ecommerce.contact');
    }

    public function about(Request $request)
    {
        return view('ecommerce.about');
    }

    public function faqs()
    {
        if (!FaqsService::hasQuestions()) abort(404);
        
        return view('ecommerce.faqs');
    }
}
