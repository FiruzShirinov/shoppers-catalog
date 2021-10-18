<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Shopper;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductValidationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_product_name_is_required()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->post(route('products.store'), [
            // 'name'  => 'Samsung s21',
            'SKU' => 'SDKJALD16089673882',
            'price' => 999,
            'image' => UploadedFile::fake()->image('avatar.jpg', 400, 400)->size(1000),
            'admin_created_id' => 1,
            'admin_updated_id' => 1,
        ]);

        $response->assertSessionHasErrors([
            'name' => 'The name field is required.'
        ]);
    }

    public function test_product_name_is_string()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->post(route('products.store'), [
            'name'  => ['as'],
            'SKU' => 'SDKJALD16089673882',
            'price' => 999,
            'image' => UploadedFile::fake()->image('avatar.jpg', 400, 400)->size(1000),
            'admin_created_id' => 1,
            'admin_updated_id' => 1,
        ]);

        $response->assertSessionHasErrors([
            'name' => 'The name must be a string.'
        ]);
    }

    public function test_product_name_must_be_at_least_2_characters()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->post(route('products.store'), [
            'name'  => '1',
            'SKU' => 'SDKJALD16089673882',
            'price' => 999,
            'image' => UploadedFile::fake()->image('avatar.jpg', 400, 400)->size(1000),
            'admin_created_id' => 1,
            'admin_updated_id' => 1,
        ]);

        $response->assertSessionHasErrors([
            'name' => 'The name must be at least 2 characters.'
        ]);
    }

    public function test_product_name_must_not_be_greater_than_256_characters()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->post(route('products.store'), [
            'name'  => $this->faker->text(3000),
            'SKU' => 'SDKJALD16089673882',
            'price' => 999,
            'image' => UploadedFile::fake()->image('avatar.jpg', 400, 400)->size(1000),
            'admin_created_id' => 1,
            'admin_updated_id' => 1,
        ]);

        $response->assertSessionHasErrors([
            'name' => 'The name must not be greater than 256 characters.'
        ]);
    }

    public function test_product_sku_is_required()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->post(route('products.store'), [
            'name'  => 'Samsung s21',
            // 'SKU' => 'SDKJALD16089673882',
            'price' => 999,
            'image' => UploadedFile::fake()->image('avatar.jpg', 400, 400)->size(1000),
            'admin_created_id' => 1,
            'admin_updated_id' => 1,
        ]);

        $response->assertSessionHasErrors([
            'SKU' => 'The s k u field is required.'
        ]);
    }

    public function test_product_sku_is_string()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->post(route('products.store'), [
            'name'  => 'as6561',
            'SKU' => ['SDKJALD16089673882'],
            'price' => 999,
            'image' => UploadedFile::fake()->image('avatar.jpg', 400, 400)->size(1000),
            'admin_created_id' => 1,
            'admin_updated_id' => 1,
        ]);

        $response->assertSessionHasErrors([
            'SKU' => 'The s k u must be a string.'
        ]);
    }

    public function test_product_sku_must_be_at_least_2_characters()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->post(route('products.store'), [
            'name'  => '1dasda5',
            'SKU' => 'S',
            'price' => 999,
            'image' => UploadedFile::fake()->image('avatar.jpg', 400, 400)->size(1000),
            'admin_created_id' => 1,
            'admin_updated_id' => 1,
        ]);

        $response->assertSessionHasErrors([
            'SKU' => 'The s k u must be at least 2 characters.'
        ]);
    }

    public function test_product_sku_must_not_be_greater_than_256_characters()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->post(route('products.store'), [
            'name'  => '$this->faker->text(3000)',
            'SKU' => $this->faker->text(3000),
            'price' => 999,
            'image' => UploadedFile::fake()->image('avatar.jpg', 400, 400)->size(1000),
            'admin_created_id' => 1,
            'admin_updated_id' => 1,
        ]);

        $response->assertSessionHasErrors([
            'SKU' => 'The s k u must not be greater than 256 characters.'
        ]);
    }

    public function test_product_price_is_required()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->post(route('products.store'), [
            'name'  => 'Samsung s21',
            'SKU' => 'SDKJALD16089673882',
            // 'price' => 999,
            'image' => UploadedFile::fake()->image('avatar.jpg', 400, 400)->size(1000),
            'admin_created_id' => 1,
            'admin_updated_id' => 1,
        ]);

        $response->assertSessionHasErrors([
            'price' => 'The price field is required.'
        ]);
    }

    public function test_product_price_must_be_a_number()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->post(route('products.store'), [
            'name'  => 'Samsung s21',
            'SKU' => 'SDKJALD16089673882',
            'price' => 'sdsa',
            'image' => UploadedFile::fake()->image('avatar.jpg', 400, 400)->size(1000),
            'admin_created_id' => 1,
            'admin_updated_id' => 1,
        ]);

        $response->assertSessionHasErrors([
            'price' => 'The price must be a number.'
        ]);
    }

    public function test_product_price_must_be_at_least_1()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->post(route('products.store'), [
            'name'  => 'Samsung s21',
            'SKU' => 'SDKJALD16089673882',
            'price' => '0',
            'image' => UploadedFile::fake()->image('avatar.jpg', 400, 400)->size(1000),
            'admin_created_id' => 1,
            'admin_updated_id' => 1,
        ]);

        $response->assertSessionHasErrors([
            'price' => 'The price must be at least 1.'
        ]);
    }

    public function test_product_price_must_not_be_greater_than_999999()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->post(route('products.store'), [
            'name'  => 'Samsung s21',
            'SKU' => 'SDKJALD16089673882',
            'price' => '9999991',
            'image' => UploadedFile::fake()->image('avatar.jpg', 400, 400)->size(1000),
            'admin_created_id' => 1,
            'admin_updated_id' => 1,
        ]);

        $response->assertSessionHasErrors([
            'price' => 'The price must not be greater than 999999.'
        ]);
    }

    public function test_product_image_must_be_an_image()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->post(route('products.store'), [
            'name'  => 'Samsung s21',
            'SKU' => 'SDKJALD16089673882',
            'price' => 999,
            'image' => UploadedFile::fake()->image('avatar.doc')->size(1000),
            'admin_created_id' => 1,
            'admin_updated_id' => 1,
        ]);

        $response->assertSessionHasErrors([
            'image' => 'The image must be an image.'
        ]);
    }

    public function test_product_image_has_invalid_image_dimensions()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->post(route('products.store'), [
            'name'  => 'Samsung s21',
            'SKU' => 'SDKJALD16089673882',
            'price' => 999,
            'image' => UploadedFile::fake()->image('avatar.jpg')->size(1000),
            'admin_created_id' => 1,
            'admin_updated_id' => 1,
        ]);

        $response->assertSessionHasErrors([
            'image' => 'The image has invalid image dimensions.'
        ]);
    }

    public function test_product_image_must_be_a_file_of_type_jpg_png()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->post(route('products.store'), [
            'name'  => 'Samsung s21',
            'SKU' => 'SDKJALD16089673882',
            'price' => 999,
            'image' => UploadedFile::fake()->image('avatar.gif')->size(1000),
            'admin_created_id' => 1,
            'admin_updated_id' => 1,
        ]);

        $response->assertSessionHasErrors([
            'image' => 'The image must be a file of type: jpg, png.'
        ]);
    }
}
