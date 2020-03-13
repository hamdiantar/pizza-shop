<?php

namespace Tests\Feature\Controllers;

use App\Models\Pizza;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class PizzasControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testCreatePizza(): void
    {
        $pizza = factory(Pizza::class)->make();

        $response = $this->json('POST', 'api/pizzas/create', [
            'flavor' => $pizza->flavor,
            'price' => $pizza->price,
        ]);
        $content = json_decode($response->getContent());
        $this->assertEquals(Response::HTTP_OK, $content->code);
        $this->assertDatabaseHas('pizzas', [
            'flavor' => $pizza->flavor,
            'price' => $pizza->price,
        ]);
    }

    public function testCreatePizzaWithWrongData(): void
    {
        $response = $this->json('POST', 'api/pizzas/create', []);
        $content = json_decode($response->getContent());
        $this->assertEquals('The flavor field is required.', $content->flavor[0]);
        $this->assertEquals('The price field is required.', $content->price[0]);
    }

    public function testUpdatePizzaWithNotFoundID(): void
    {
        $response = $this->json('PUT', 'api/pizzas/update/1234566');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function testUpdatePizza(): void
    {
        $pizza = factory(Pizza::class)->create();
        $pizzaUpdate = factory(Pizza::class)->create();
        $response = $this->json('PUT', 'api/pizzas/update/' . $pizza->id, [
            'flavor' => $pizzaUpdate->flavor,
            'price' => $pizzaUpdate->price,
        ]);
        $content = json_decode($response->getContent());
        $this->assertEquals(Response::HTTP_OK, $content->code);
        $this->assertDatabaseHas('pizzas', [
            'flavor' => $pizzaUpdate->flavor,
            'price' => $pizzaUpdate->price,
        ]);
    }

    public function testDeletePizza(): void
    {
        $pizza = factory(Pizza::class)->create();
        $response = $this->json('DELETE', 'api/pizzas/delete/' . $pizza->id);
        $content = json_decode($response->getContent());
        $this->assertEquals(Response::HTTP_OK, $content->code);
        $this->assertDatabaseMissing('pizzas', [
            'flavor' => $pizza->flavor,
            'price' => $pizza->price,
            'deleted_at' => null
        ]);
    }
}
