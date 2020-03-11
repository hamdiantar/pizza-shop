<?php

namespace App\Services;

use App\Helper\ReturnData;
use App\Models\Pizza;
use App\Repositories\PizzaRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class PizzaService
{
    /**
     * @var PizzaRepository
     */
    protected $pizzaRepository;

    /**
     * @var ReturnData
     */
    protected $returnData;

    /**
     * @var array
     */
    protected $sizes = [1, 2, 3];

    public function __construct(PizzaRepository $pizzaRepository, ReturnData $returnData)
    {
        $this->pizzaRepository = $pizzaRepository;
        $this->returnData = $returnData;
    }

    public function createPizza(array $pizzaData): array
    {
        try {
            if ($pizza = $this->pizzaRepository->create($pizzaData)) {
                $this->addSizes($pizza);
                return $this->returnData->create(
                    [],
                    JsonResponse::HTTP_OK,
                    $pizza->toArray(),
                    ['pizza has been created successfully']);
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
            ['pizza has not created']);
    }

    public function updatePizza(Pizza $pizza, array $pizzaData): array
    {
        try {
            if ($this->pizzaRepository->update($pizzaData, $pizza->id)) {
                return $this->returnData->create(
                    [],
                    JsonResponse::HTTP_OK,
                    $pizza->fresh()->toArray(),
                    ['pizza has been update successfully']);
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
            ['pizza has not updated']);
    }

    public function deletePizza(Pizza $pizza): array
    {
        try {
            if ($this->pizzaRepository->delete($pizza->id)) {
                $this->removeSizes($pizza);
                return $this->returnData->create(
                    [],
                    JsonResponse::HTTP_OK,
                    [],
                    ['pizza has been deleted successfully']);
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
            ['pizza has not deleted']);
    }

    private function addSizes(Pizza $pizza): void
    {
        $pizza->sizes()->attach($this->sizes);
    }

    private function removeSizes(Pizza $pizza): void
    {
        $pizza->sizes()->detach($this->sizes);
    }
}
