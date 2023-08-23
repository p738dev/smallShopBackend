<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class OrderRepository implements OrderRepositoryInterface 
{
    /**
     * @return LengthAwarePaginator
     */
    public function index(Request $request) {
        $orders = Order::paginate(10);
        return $orders;
    }

    /**
     * @param int $id
     * @return ?Order
     */
    public function show(int $id) {
        $order = Order::findOrFail($id);
        return $order;
    }
}