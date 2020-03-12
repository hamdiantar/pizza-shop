<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCustomerRequest;
use App\Responses\ApiResponse;
use App\Services\CustomerService;
use Illuminate\Http\JsonResponse;

class CustomersController extends Controller
{
    /**
     * @var CustomerService
     */
    protected $customerService;

    /**
     * @var ApiResponse
     */
    protected $apiResponse;

    public function __construct(CustomerService $customerService, ApiResponse $apiResponse)
    {
        $this->customerService = $customerService;
        $this->apiResponse = $apiResponse;
    }

    public function create(CreateCustomerRequest $request): JsonResponse
    {
        $customer = $this->customerService->CreateCustomer($request->validated());
        return $this->apiResponse
            ->setData($customer->toArray())
            ->setMessages(['customer has been created successfully'])
            ->setCode(JsonResponse::HTTP_OK)
            ->create();
    }
}
