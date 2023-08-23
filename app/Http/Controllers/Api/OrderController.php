<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Contracts\OrderServiceInterface;

class OrderController extends Controller
{
    private OrderRepositoryInterface $orderRepository;
    private OrderServiceInterface $orderService;

    public function __construct(OrderRepositoryInterface $orderRepository, OrderServiceInterface $orderService){
        $this->orderRepository = $orderRepository;
        $this->orderService = $orderService;
    }

    /**
     * @return array
     */
    public function index(Request $request) {
        return $this->orderRepository->index($request);
    }

    /**
     * @return ?Order
     */
    public function show(string $id) {
        return $this->orderRepository->show($id);
    }

    /**
     * Store order
     * @param $request
     * @return JsonResponse
     */
    public function store(Request $request) {
        return $this->orderService->store($request);
    }

    /**
     * Destroy order
     * @param $request
     * @return JsonResponse
     */
    public function destroy(string $id) {
        return $this->orderService->destroy($id);
    }
}