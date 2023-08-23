<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository implements ProductRepositoryInterface 
{
    /**
     * @return LengthAwarePaginator
     */
    public function index(Request $request) {
        $search_param = $request->query('search');
        $query = Product::query();

        if ($search_param) {
            $query->where('title', 'like', '%' . $search_param . '%');
        }
        $products = $query->paginate(10);
        return $products;
    } 

    /**
     * @param string $id
     * @return ?Product
     */
    public function show(string $id) {
        $product = Product::findOrFail($id);
        return $product;
    }
}