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
        $search_param = $request->query('searchParam');
        $sort_param = $request->query('sortParam');
        $query = Product::query();

        if ($search_param) {
            $query->where('title', 'like', '%' . $search_param . '%');
        }
        if($sort_param) {
        $query->orderBy('price', strtoupper($sort_param));
        }
        
        $products = $query->paginate(7);
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