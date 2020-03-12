<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\GetOrderRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Models\Order;
use App\Responses\ApiResponse;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;

class OrdersController extends Controller
{
    /**
     * @var OrderService
     */
    protected $orderService;

    /**
     * @var ApiResponse
     */
    protected $apiResponse;

    public function __construct(OrderService $orderService, ApiResponse $apiResponse)
    {
        $this->orderService = $orderService;
        $this->apiResponse = $apiResponse;
    }

    public function create(CreateOrderRequest $request): JsonResponse
    {
        $orderData = $this->orderService->createOrder($request->validated());
        return $this->apiResponse
            ->setData($orderData['data'])
            ->setMessages($orderData['messages'])
            ->setErrors($orderData['errors'])
            ->setCode($orderData['code'])
            ->create();
    }

    public function updateStatus(UpdateStatusRequest $request, Order $order): JsonResponse
    {
        $status = $this->orderService->updateStatusOrder($order, $request->status);
        return $this->apiResponse
            ->setMessages($status['messages'])
            ->setErrors($status['errors'])
            ->setCode($status['code'])
            ->create();
    }

    public function deleteOrder(Order $order): JsonResponse
    {
        $deleteOrder = $this->orderService->deleteOrder($order);
        return $this->apiResponse
            ->setMessages($deleteOrder['messages'])
            ->setErrors($deleteOrder['errors'])
            ->setCode($deleteOrder['code'])
            ->create();
    }

    public function getOrder(GetOrderRequest $request): JsonResponse
    {
        if ($order = $this->orderService->getOrderByCriteria($request->validated())) {
            return $this->apiResponse
                ->setData($order->toArray())
                ->setMessages(['order fetched successfully'])
                ->setCode(JsonResponse::HTTP_OK)
                ->create();
        }
        return $this->apiResponse
            ->setCode(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->setMessages(['order not fount'])
            ->create();
    }

    public function listOrders(): JsonResponse
    {
        $orders = $this->orderService->getAllOrders();
        return $this->apiResponse
            ->setData($orders->toArray())
            ->setMessages(['orders fetched successfully'])
            ->setCode(JsonResponse::HTTP_OK)
            ->create();
    }
}
