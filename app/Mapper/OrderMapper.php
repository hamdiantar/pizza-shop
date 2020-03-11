<?php

namespace App\Mapper;

use App\Models\Order;
use App\Repositories\CustomerRepository;
use App\Repositories\PizzaRepository;

class OrderMapper
{
    /**
     * @var CustomerRepository
     */
    protected $customerRepository;

    /**
     * @var PizzaRepository
     */
    protected $pizzaRepository;

    public function __construct(CustomerRepository $customerRepository, PizzaRepository $pizzaRepository)
    {
        $this->customerRepository = $customerRepository;
        $this->pizzaRepository = $pizzaRepository;
    }

    public function map(Order $order): array
    {
        $customer = $this->customerRepository->find($order->customer_id);
        $pizza = $this->pizzaRepository->find($order->pizza_id);
        return [
            'customer_name' => $customer->name,
            'customer_address' => $customer->address,
            'customer_phone' => $customer->phone ?? null,
            'flavors' => $pizza->flavor,
            'price' => $pizza->price,
            'total_price' => $pizza->price * $order->quantity,
            'status' => $order->status
        ];
    }
}
