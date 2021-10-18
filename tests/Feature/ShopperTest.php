<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Shopper;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Artisan;
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

        $response = $this->post(route('shoppers.store'), $shppr = [
            'name'  => 'John Doe',
            'phone' => '+16089673882',
            'email' => 'john.doe@gmail.com',
            'password'  => 'johndoe1234!',
            'image' => UploadedFile::fake()->image('avatar.jpg', 400, 400)->size(1000),
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
                'name'  => $shppr['name'],
                'email' => $shppr['email'],
                'phone' => $shppr['phone'],
                'image' => '/storage/'.time().'.'.$shppr['image']->extension(),
                'admin_created_id' => $shopper->id,
                'admin_updated_id' => $shopper->id,
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

        $response = $this->patch(route('shoppers.update', $shopper), $shppr = [
            'name'  => 'John Doe',
            'email' => 'john.doe@gmail.com',
            'phone' => '+16089673882',
            'image' => UploadedFile::fake()->image('avatar.jpg', 400, 400)->size(1000),
        ]);

        $response->assertSessionHasNoErrors([
            'name',
            'phone',
            'email',
        ]);

        $this->assertDatabaseHas(
            'shoppers',
            [
                'name'  => $shppr['name'],
                'email' => $shppr['email'],
                'phone' => $shppr['phone'],
                'image' => '/storage/'.time().'.'.$shppr['image']->extension(),
                'admin_created_id' => '1',
                'admin_updated_id' => $shopper->id
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
