<?php
declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface OrderRepositoryInterface 
{
    /**
     * @return array
     */
    public function index(Request $request);
    
    /**
     * @return ?Order
     */
    public function show(string $id);   
}