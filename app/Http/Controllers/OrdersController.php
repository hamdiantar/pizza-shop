<?php

namespace App\Http\Controllers;

use App\Http\Requests\Web\CreateOrderRequest;
use App\Models\Customer;
use App\Models\Size;
use App\Services\CustomerService;
use App\Services\OrderService;
use App\Services\PizzaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class OrdersController extends Controller
{
    /**
     * @var CustomerService
     */
    protected $customerService;

    /**
     * @var PizzaService
     */
    protected $pizzaService;

    /**
     * @var OrderService
     */
    protected $orderService;

    public function __construct(
        CustomerService $customerService,
        PizzaService $pizzaService,
        OrderService $orderService
    ) {
        $this->customerService = $customerService;
        $this->pizzaService = $pizzaService;
        $this->orderService = $orderService;
        $this->middleware('auth');
    }

    public function index(): View
    {
        $this->orderService->getAllOrders();
        return view('orders.index', ['orders' => Cache::get('orders')]);
    }

    public function create(): View
    {
        //this line should go to repo, so will be reusable in future
        $sizes = Size::pluck('id', 'size');
        $pizzas = $this->pizzaService->getAllPizza();
        return view('orders.create', compact('sizes', 'pizzas'));
    }

    public function store(CreateOrderRequest $request): RedirectResponse
    {
        if ($customer = $this->customerService->CreateCustomer($request->only('name', 'address'))) {
            $this->orderService->createOrder($this->mapOrderData($request, $customer));
            return back()->with('success', 'order has been created successfully');
        }
        return back()->with('fail', 'order has not created');
    }

    private function mapOrderData(Request $request, Customer $customer): array
    {
        return array(
            'customer_id' => $customer->id,
            'pizza_id' => $request->pizza,
            'size' => $request->size,
            'quantity' => $request->quantity,
            'status' => $request->status,
        );
    }
}
