<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Shopper;
use Illuminate\Validation\Rule;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShopperTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the shoppers index page is rendered
     *
     * @return void
     */
    public function test_shoppers_index_page_is_rendered()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });

        $this->actingAs($shopper);

        $response = $this->get(route('shoppers.index'));

        $response->assertStatus(200);
    }

    /**
     * Test if the shoppers create page is rendered
     *
     * @return void
     */
    public function test_shoppers_create_page_is_rendered()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });

        $this->actingAs($shopper);

        $response = $this->get(route('shoppers.create'));

        $response->assertStatus(200);
    }

    /**
     * Test if the shoppers create page requires validation
     *
     * @return void
     */
    public function test_shoppers_create_page_requires_validation()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });

        $this->actingAs($shopper);

        $response = $this->post(route('shoppers.store'));

        $response->assertSessionHasErrors([
            'name',
            'phone',
            'email',
            'image',
            'password'
        ]);
    }

    /**
     * Test if the shoppers can be created
     *
     * @return void
     */
    public function test_shoppers_can_be_created()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });

        $this->actingAs($shopper);

        // Cannot pass the test because of upload image minimum dimensions
        $response = $this->post(route('shoppers.store'), [
            'name'  => 'John Doe',
            'phone' => '+16089673882',
            'email' => 'john.doe@gmail.com',
            'password'  => 'johndoe1234!',
            'image' => UploadedFile::fake()->create('example.jpg'),
        ]);

        $response->assertSessionHasNoErrors([
            'name',
            'phone',
            'email',
            'image',
            'password'
        ]);

        $this->assertEquals(2, Shopper::count());

        $this->assertDatabaseHas(
            'shoppers',
            [
                'name'  => 'John Doe',
                'email' => 'john.doe@gmail.com',
                'phone' => '+14031234567',
                'password'  => bcrypt('johndoe1234!'),
                'image' => 'example.jpg',
                'admin_created_id' => 1,
                'admin_updated_id' => 1
            ]
        );

        $response->assertStatus(302);
        $response->assertRedirect(route('shoppers.index'));
    }

    /**
     * Test if the shoppers create edit is rendered
     *
     * @return void
     */
    public function test_shoppers_edit_page_is_rendered()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });

        $this->actingAs($shopper);

        $response = $this->get(route('shoppers.edit', 1));

        $response->assertStatus(200);
    }

    /**
     * Test if the shoppers can be updated
     *
     * @return void
     */
    public function test_shoppers_can_be_updated()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });

        $this->actingAs($shopper);

        // Cannot pass the test because of upload image minimum dimensions
        $response = $this->post(route('shoppers.update', $shopper), [
            'name'  => 'John Doe',
            'phone' => '+16089673882',
            'email' => 'john.doe@gmail.com',
            'password'  => 'johndoe1234!',
            'image' => UploadedFile::fake()->create('example.jpg'),
        ]);

        $response->assertSessionHasNoErrors([
            'name',
            'phone',
            'email',
            'image',
            'password'
        ]);

        $this->assertDatabaseHas(
            'shoppers',
            [
                'name'  => 'John Doe',
                'email' => 'john.doe@gmail.com',
                'phone' => '+14031234567',
                'password'  => bcrypt('johndoe1234!'),
                'image' => 'example.jpg',
                'admin_created_id' => 1,
                'admin_updated_id' => 1
            ]
        );

        $response->assertStatus(302);
        $response->assertRedirect(route('shoppers.index'));
    }

    /**
     * Test if shoppers can be deleted
     *
     * @return void
     */
    public function test_shopper_can_be_deleted()
    {
        Artisan::call('config:clear');
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });

        $shopper2 = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });

        $this->actingAs($shopper);

        $response = $this->delete(route('shoppers.destroy', $shopper2));

        $response->assertStatus(302);
        $response->assertRedirect(route('shoppers.index'));
    }
}
