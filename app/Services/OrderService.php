<?php

namespace App\Services;

use App\Helper\ReturnData;
use App\Mapper\OrderMapper;
use App\Models\Customer;
use App\Models\Order;
use App\Repositories\CustomerRepository;
use App\Repositories\OrderRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class OrderService
{
    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    /**
     * @var CustomerRepository
     */
    protected $customerRepository;

    /**
     * @var ReturnData
     */
    protected $returnData;

    /**
     * @var OrderMapper
     */
    protected $orderMapper;

    public function __construct(
        OrderRepository $orderRepository,
        CustomerRepository $customerRepository,
        ReturnData $returnData,
        OrderMapper $orderMapper
    )
    {
        $this->orderRepository = $orderRepository;
        $this->customerRepository = $customerRepository;
        $this->returnData = $returnData;
        $this->orderMapper = $orderMapper;
    }

    public function createOrder(array $orderData): array
    {
        try {
            if ($order = $this->orderRepository->create($orderData)) {
                $orderData = $this->orderMapper->map($order);
                return $this->returnData->create(
                    [],
                    JsonResponse::HTTP_OK,
                    $orderData,
                    ['order has been created successfully']);
            }
        } catch (Exception $e) {
            Log::error($e->getMessage(), [
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'stack-trace' => $e->getTraceAsString()
            ]);
        }
        return $this->returnData->create(
            [],
            JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
            [],
            ['order has not created']);
    }

    public function updateStatusOrder(Order $order, string $status): array
    {
        try {
            if ($this->orderRepository->update(['status' => $status], $order->id)) {
                return $this->returnData->create(
                    [],
                    JsonResponse::HTTP_OK,
                    [],
                    ['status has been updated successfully']);
            }
        } catch (Exception $e) {
            Log::error($e->getMessage(), [
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'stack-trace' => $e->getTraceAsString()
            ]);
        }
        return $this->returnData->create(
            [],
            JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
            [],
            ['status has not updated']);
    }

    public function deleteOrder(Order $order): array
    {
        try {
            if ($this->checkOrderStatus($order)) {
                $this->orderRepository->delete($order->id);
                return $this->returnData->create([], JsonResponse::HTTP_OK, [], ['order has been deleted successfully']);
            }
            return $this->returnData->create([], JsonResponse::HTTP_UNPROCESSABLE_ENTITY, [], ['order still not delivered']);
        } catch (Exception $e) {
            Log::error($e->getMessage(), [
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'stack-trace' => $e->getTraceAsString()
            ]);
        }
        return $this->returnData->create([], JsonResponse::HTTP_UNPROCESSABLE_ENTITY, [], ['some thing wrong']);
    }

    public function getOrderByCriteria(array $criteria): ?Order
    {
        if (isset($criteria['id'])) {
            $order = $this->orderRepository->findOneBy(['id' => $criteria['id']]);
        }
        if (isset($criteria['name'])) {
            $customer = $this->customerRepository->findOneBy(['name' => $criteria['name']]);
            $order = $this->orderRepository->findOneBy(['customer_id' => $customer->id]);
        }
        return $order;
    }

    public function getAllOrders(): Collection
    {
        return $this->orderRepository->findAll();
    }

    private function checkOrderStatus(Order $order): bool
    {
        return $order->status === 'delivered';
    }
}
