<?php
declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface 
{
    /**
     * @return LengthAwarePaginator
     */
    public function index(Request $request);

    /**
     * @return ?Product
     */
    public function show(string $id);

}