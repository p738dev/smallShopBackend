<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Services\Contracts\OrderServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderService implements OrderServiceInterface 
{
    private OrderRepositoryInterface $orderRepository;
    private Order $orderModel;

    public function __construct(OrderRepositoryInterface $orderRepository,  Order $orderModel) {
        $this->orderRepository = $orderRepository;
        $this->orderModel = $orderModel;
    }

    /**
     * Store order
     * @param $request
     * @return JsonResponse
     */
    public function store(Request $request): array {
        $data = $request->all();
        $order = new Order();
        $order->id=Str::uuid()->toString();
        $order->user_id = $data['user_id'];
        $order->save();
        
        $orderProductData = [];
        foreach($request['productsIds'] as $productId) {
            array_push($orderProductData, (object)[
                'id'=>Str::uuid()->toString(),
                'order_id'=>$order->id,
                'product_id'=>$productId
            ]);
        }
        foreach($orderProductData as $item) {
            DB::table('order_product')->insert((array)$item);
        }
        return ['success'=>true];
    }

    /**
     * Destroy order
     * @param $request
     * @return JsonResponse
     */
    public function destroy(string $id): array {
        $success = $this->orderModel::destroy($id);
        return ['success'=>boolval($success)];
    }
}