<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Services\Contracts\ProductServiceInterface;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductService implements ProductServiceInterface 
{
    private ProductRepositoryInterface $productRepository;
    private Product $productModel;

    public function __construct(ProductRepositoryInterface $productRepository, Product $productModel) {
        $this->productRepository = $productRepository;
        $this->productModel = $productModel;
    }

    /**
     * Store product
     * @param $request
     * @return JsonResponse
     */
    public function store(Request $request){
        try {
            $validateProduct = Validator::make($request->all(),
            [
                'title' => 'required', 
                'desc' => 'required',
                'category' => 'required',
                'price' => 'required|numeric',
            ]);

            if ($validateProduct->fails()) {
                return response()->json([
                    'is_success' => false,
                    'message' => 'Błąd walidacji produktu',
                ], 401);
            };

            $product = new Product();
            $product->id = Str::uuid()->toString();
            $product->title = $request->title;
            $product->desc = $request->desc;
            $product->category = $request->category;
            $product->price = $request->price;
            $product->save();

            return response()->json([
                'is_success' => true,
                'message' => 'Poprawnie dodano produkt',
            ], 200);
            
        } catch (\Throwable $th) {
            return response()->json([
                'is_success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Update product
     * @param $request, $id
     * @return ?Product
     */
    public function update(Request $request, string $id) {
        try {
            $validateProductUpdate = Validator::make($request->all(),
            [
                'title' => 'required', 
                'desc' => 'required',
                'category' => 'required',
                'price' => 'required|numeric',
            ]);

            if ($validateProductUpdate->fails()) {
                return response()->json([
                    'is_success' => false,
                    'message' => 'Błąd walidacji podczas edytowania produktu',
                ], 401);
            };

            $product = Product::find($id);
            $product->title = $request->title;
            $product->desc = $request->desc;
            $product->category = $request->category;
            $product->price = $request->price;
            $product->save();
            
            return response()->json([
                'is_success' => true,
                'message' => 'Poprawnie edytowano produkt',
            ], 200);
            
        } catch (\Throwable $th) {
            return response()->json([
                'is_success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Destroy product
     * @param $id
     * @return JsonResponse
     */
    public function destroy(string $id) {
        $product = Product::find($id);
        $product->delete();

        return response()->json([
            'is_success' => true,
            'message' => 'Produkt został usunięty poprawnie',
        ], 200);
    }
}