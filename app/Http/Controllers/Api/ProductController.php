<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ApiResponse;

    public function productList()
    {
        try {
            $product = Product::select('title', 'image')->get();
            return $this->success($product, 'All Product List', 200);
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage(), 500);
        }
    }


    public function exploreAll()
    {
        try {
            $product = Category::select('id', 'name')->with('products')->get();

            return $this->success($product, 'All Product List', 200);
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage(), 500);
        }
    }

    public function productSearch(Request $request)
    {
        try {

            $productNameSearch = $request->input('title');
            $productCategory = $request->input('name');

            $searchProduct = Product::with('Category')
                ->when($productNameSearch, function ($query, $productNameSearch) {
                    $query->where('title', 'like', '%' . $productNameSearch . '%');
                })
                ->when($productCategory, function ($query, $productCategory) {
                    $query->whereHas('Category', function ($categoryQuery) use ($productCategory) {
                        $categoryQuery->where('name', 'like', '%' . $productCategory . '%');
                    });
                })
                ->get();
            return $this->success($searchProduct, 'All Product Search List', 200);
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage(), 500);
        }
    }
}
