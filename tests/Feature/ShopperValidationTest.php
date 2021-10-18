<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Shopper;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShopperValidationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_shopper_name_is_required()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->post(route('shoppers.store'), [
            // 'name'  => 'John Doe',
            'phone' => '+16089673882',
            'email' => 'john.doe@gmail.com',
            'password'  => 'johndoe1234!',
            'image' => UploadedFile::fake()->image('avatar.jpg', 400, 400)->size(1000),
        ]);

        $response->assertSessionHasErrors([
            'name' => 'The name field is required.'
        ]);
    }

    public function test_shopper_name_is_string()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->post(route('shoppers.store'), [
            'name'  => ['John Doe'],
            'phone' => '+16089673882',
            'email' => 'john.doe@gmail.com',
            'password'  => 'johndoe1234!',
            'image' => UploadedFile::fake()->image('avatar.jpg', 400, 400)->size(1000),
        ]);

        $response->assertSessionHasErrors([
            'name' => 'The name must be a string.'
        ]);
    }

    public function test_shopper_name_must_be_at_least_2_characters()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->post(route('shoppers.store'), [
            'name'  => 'J',
            'phone' => '+16089673882',
            'email' => 'john.doe@gmail.com',
            'password'  => 'johndoe1234!',
            'image' => UploadedFile::fake()->image('avatar.jpg', 400, 400)->size(1000),
        ]);

        $response->assertSessionHasErrors([
            'name' => 'The name must be at least 2 characters.'
        ]);
    }

    public function test_shopper_name_must_not_be_greater_than_256_characters()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->post(route('shoppers.store'), [
            'name'  => $this->faker->text(3000),
            'phone' => '+16089673882',
            'email' => 'john.doe@gmail.com',
            'password'  => 'johndoe1234!',
            'image' => UploadedFile::fake()->image('avatar.jpg', 400, 400)->size(1000),
        ]);

        $response->assertSessionHasErrors([
            'name' => 'The name must not be greater than 256 characters.'
        ]);
    }

    public function test_shopper_phone_is_required()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->post(route('shoppers.store'), [
            'name'  => 'John Doe',
            // 'phone' => '+16089673882',
            'email' => 'john.doe@gmail.com',
            'password'  => 'johndoe1234!',
            'image' => UploadedFile::fake()->image('avatar.jpg', 400, 400)->size(1000),
        ]);

        $response->assertSessionHasErrors([
            'phone' => 'The phone field is required.'
        ]);
    }

    public function test_shopper_phone_field_contains_an_invalid_number()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->post(route('shoppers.store'), [
            'name'  => 'John Doe',
            'phone' => '+160873882',
            'email' => 'john.doe@gmail.com',
            'password'  => 'johndoe1234!',
            'image' => UploadedFile::fake()->image('avatar.jpg', 400, 400)->size(1000),
        ]);

        $response->assertSessionHasErrors([
            'phone' => 'The phone field contains an invalid number.'
        ]);
    }

    public function test_shopper_email_is_required()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->post(route('shoppers.store'), [
            'name'  => 'John Doe',
            'phone' => '+16089673882',
            // 'email' => 'john.doe@gmail.com',
            'password'  => 'johndoe1234!',
            'image' => UploadedFile::fake()->image('avatar.jpg', 400, 400)->size(1000),
        ]);

        $response->assertSessionHasErrors([
            'email' => 'The email field is required.'
        ]);
    }

    public function test_shopper_email_must_be_a_valid_email_address()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->post(route('shoppers.store'), [
            'name'  => 'John Doe',
            'phone' => '+16089673882',
            'email' => 'john.doegmail.com',
            'password'  => 'johndoe1234!',
            'image' => UploadedFile::fake()->image('avatar.jpg', 400, 400)->size(1000),
        ]);

        $response->assertSessionHasErrors([
            'email' => 'The email must be a valid email address.'
        ]);
    }

    public function test_shopper_email_must_be_at_least_6_characters()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->post(route('shoppers.store'), [
            'name'  => 'John Doe',
            'phone' => '+16089673882',
            'email' => 'j@g.c',
            'password'  => 'johndoe1234!',
            'image' => UploadedFile::fake()->image('avatar.jpg', 400, 400)->size(1000),
        ]);

        $response->assertSessionHasErrors([
            'email' => 'The email must be at least 6 characters.'
        ]);
    }

    public function test_shopper_email_must_not_be_greater_than_255_characters()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->post(route('shoppers.store'), [
            'name'  => 'John Doe',
            'phone' => '+16089673882',
            'email' => $this->faker->text(30000).$this->faker->email(),
            'password'  => 'johndoe1234!',
            'image' => UploadedFile::fake()->image('avatar.jpg', 400, 400)->size(1000),
        ]);

        $response->assertSessionHasErrors([
            'email' => 'The email must not be greater than 255 characters.'
        ]);
    }

    public function test_shopper_image_must_be_an_image()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->post(route('shoppers.store'), [
            'name'  => 'John Doe',
            'phone' => '+16089673882',
            'email' => 'john.doe@gmail.com',
            'password'  => 'johndoe1234!',
            'image' => UploadedFile::fake()->image('avatar.doc')->size(1000),
        ]);

        $response->assertSessionHasErrors([
            'image' => 'The image must be an image.'
        ]);
    }

    public function test_shopper_image_has_invalid_image_dimensions()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->post(route('shoppers.store'), [
            'name'  => 'John Doe',
            'phone' => '+16089673882',
            'email' => 'john.doe@gmail.com',
            'password'  => 'johndoe1234!',
            'image' => UploadedFile::fake()->image('avatar.jpg')->size(1000),
        ]);

        $response->assertSessionHasErrors([
            'image' => 'The image has invalid image dimensions.'
        ]);
    }

    public function test_shopper_image_must_be_a_file_of_type_jpg_png()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->post(route('shoppers.store'), [
            'name'  => 'John Doe',
            'phone' => '+16089673882',
            'email' => 'john.doe@gmail.com',
            'password'  => 'johndoe1234!',
            'image' => UploadedFile::fake()->image('avatar.gif')->size(1000),
        ]);

        $response->assertSessionHasErrors([
            'image' => 'The image must be a file of type: jpg, png.'
        ]);
    }

    public function test_shopper_password_must_be_at_least_8_characters()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->post(route('shoppers.store'), [
            'name'  => 'John Doe',
            'phone' => '+16089673882',
            'email' => 'john.doe@gmail.com',
            'password'  => 'jd1234!',
            'image' => UploadedFile::fake()->image('avatar.jpg', 400, 400)->size(1000),
        ]);

        $response->assertSessionHasErrors([
            'password' => 'The password must be at least 8 characters.'
        ]);
    }

    public function test_shopper_password_must_not_be_greater_than_50_characters()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });
        $this->actingAs($shopper);

        $response = $this->post(route('shoppers.store'), [
            'name'  => 'John Doe',
            'phone' => '+16089673882',
            'email' => 'john.doe@gmail.com',
            'password'  => $this->faker->text(100),
            'image' => UploadedFile::fake()->image('avatar.jpg', 400, 400)->size(1000),
        ]);

        $response->assertSessionHasErrors([
            'password' => 'The password must not be greater than 50 characters.'
        ]);
    }
}
