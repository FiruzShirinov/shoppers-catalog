<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Shopper;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PurchaseTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the purchases create page is rendered
     *
     * @return void
     */
    public function test_purchases_create_page_is_rendered()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->get(route('purchases.create'));

        $response->assertStatus(200);
    }

    /**
     * Test the purchases can be created
     *
     * @return void
     */
    public function test_purchases_can_be_created()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $product =  Product::factory()->create();

        $this->assertEquals(1, Product::count());

        $response = $this->post(route('purchases.store'), [
            'shopper_id' => $shopper->id,
            'product_id' => $product->id
        ]);

        $this->assertDatabaseHas(
            'product_purchase',
            [
                'purchase_id'  => 1,
                'product_id' => $product->id,
            ]
        );

        $this->assertDatabaseHas(
            'purchases',
            [
                'shopper_id' => $shopper->id,
                'total' => $product->price,
            ]
        );

        $response->assertStatus(302);
        $response->assertRedirect(route('shoppers.index'));
    }
}
