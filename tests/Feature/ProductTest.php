<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Shopper;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the products index page is rendered
     *
     * @return void
     */
    public function test_products_index_page_is_rendered()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->get(route('products.index'));

        $response->assertStatus(200);
    }

    /**
     * Test if the products create page is rendered
     *
     * @return void
     */
    public function test_products_create_page_is_rendered()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->get(route('products.create'));

        $response->assertStatus(200);
    }

    /**
     * Test if the products can be created
     *
     * @return void
     */
    public function test_products_can_be_created()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });

        $this->actingAs($shopper);

        $response = $this->post(route('products.store'), $product = [
            'name'  => 'Samsung s21',
            'SKU' => 'SDKJALD16089673882',
            'price' => 999,
            'image' => UploadedFile::fake()->image('avatar.jpg', 400, 400)->size(1000),
            'admin_created_id' => 1,
            'admin_updated_id' => 1,
        ]);

        $response->assertSessionHasNoErrors([
            'name',
            'phone',
            'email',
            'image',
            'password'
        ]);

        $this->assertEquals(1, Product::count());

        $this->assertDatabaseHas(
            'products',
            [
                'name' => $product['name'],
                'SKU' => $product['SKU'],
                'price' => $product['price']*100,
                'image' => '/storage/'.time().'.'.$product['image']->extension(),
                'admin_created_id' => $shopper->id,
                'admin_updated_id' => $shopper->id,
            ]
        );

        $response->assertStatus(302);
        $response->assertRedirect(route('products.index'));
    }

    /**
     * Test if the products create edit is rendered
     *
     * @return void
     */
    public function test_products_edit_page_is_rendered()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $product = Product::factory()->create();

        $response = $this->get(route('products.edit', $product));

        $response->assertStatus(200);
    }

    /**
     * Test if the products can be updated
     *
     * @return void
     */
    public function test_products_can_be_updated()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });

        $this->actingAs($shopper);

        $prdct = Product::factory()->create();

        $response = $this->patch(route('products.update', $prdct), $product = [
            'name'  => 'Samsung s21',
            'SKU' => 'SDKJALD16089673882',
            'price' => 999,
            'image' => UploadedFile::fake()->image('avatar.jpg', 400, 400)->size(1000),
        ]);

        $response->assertSessionHasNoErrors([
            'name',
            'SKU',
            'price',
        ]);

        $this->assertDatabaseHas(
            'products',
            [
                'name' => $product['name'],
                'SKU' => $product['SKU'],
                'price' => $product['price']*100,
                'image' => '/storage/'.time().'.'.$product['image']->extension(),
                'admin_created_id' => $shopper['admin_created_id'],
                'admin_updated_id' => $shopper['admin_updated_id'],
            ]
        );

        $response->assertStatus(302);
        $response->assertRedirect(route('products.index'));
    }

    /**
     * Test if products can be deleted
     *
     * @return void
     */
    public function test_product_can_be_deleted()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });

        $product = Product::withoutEvents(function () {
            return Product::factory()->create();
        });

        $this->actingAs($shopper);

        $response = $this->delete(route('products.destroy', $product));

        $response->assertStatus(302);
        $response->assertRedirect(route('products.index'));
    }
}
