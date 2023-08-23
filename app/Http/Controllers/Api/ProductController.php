<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Services\Contracts\ProductServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;


class ProductController extends Controller
{  
    /**
     * @var ProductRepository
     * @var ProductService
     */
    private ProductRepositoryInterface $productRepository;
    private ProductServiceInterface $productService;
    
    /**
     * @param ProductRepository $productRepository
     * @param ProductService $productService
     */
    public function __construct (ProductRepositoryInterface $productRepository, ProductServiceInterface $productService){
        $this->productRepository = $productRepository;
        $this->productService = $productService;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function index(Request $request) {
        return $this->productRepository->index($request);
    }

    /**
     * @return ?Product
     */
    public function show(string $id) {
        return $this->productRepository->show($id);
    }

    /**
     * Store product
     * @param $request
     * @return JsonResponse
     */
    public function store(Request $request) {
        return $this->productService->store($request);
    }

     /**
     * Update product
     * @param $request, $id
     * @return ?Product
     */
    public function update(Request $request, string $id) {
        return $this->productService->update($request, $id);
    }

    
    /**
     * Destroy product
     * @param $id
     * @return JsonResponse
     */
    public function destroy(string $id) {
        return $this->productService->destroy($id);
    }
} 