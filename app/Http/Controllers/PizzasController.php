<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePizzaRequest;
use App\Http\Requests\UpdatePizzaRequest;
use App\Models\Pizza;
use App\Responses\ApiResponse;
use App\Services\PizzaService;
use Illuminate\Http\JsonResponse;

class PizzasController extends Controller
{
    /**
     * @var PizzaService
     */
    protected $pizzaService;

    /**
     * @var ApiResponse
     */
    protected $apiResponse;

    public function __construct(PizzaService $pizzaService, ApiResponse $apiResponse)
    {
        $this->pizzaService = $pizzaService;
        $this->apiResponse = $apiResponse;
    }

    public function create(CreatePizzaRequest $request): JsonResponse
    {
        $pizzaData = $this->pizzaService->createPizza($request->validated());
        return $this->apiResponse
            ->setData($pizzaData['data'])
            ->setMessages($pizzaData['messages'])
            ->setErrors($pizzaData['errors'])
            ->setCode($pizzaData['code'])
            ->create();
    }

    public function update(UpdatePizzaRequest $request, Pizza $pizza): JsonResponse
    {
        $pizzaData = $this->pizzaService->updatePizza($pizza, $request->validated());
        return $this->apiResponse
            ->setData($pizzaData['data'])
            ->setMessages($pizzaData['messages'])
            ->setErrors($pizzaData['errors'])
            ->setCode($pizzaData['code'])
            ->create();
    }

    public function delete(Pizza $pizza): JsonResponse
    {
        $pizzaData = $this->pizzaService->deletePizza($pizza);
        return $this->apiResponse
            ->setMessages($pizzaData['messages'])
            ->setErrors($pizzaData['errors'])
            ->setCode($pizzaData['code'])
            ->create();
    }
}
