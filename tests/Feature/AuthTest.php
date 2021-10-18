<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Shopper;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if login page is rendered
     *
     * @return void
     */
    public function test_login_is_rendered()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
    }

    /**
     * Test if shoppers can log in with correct credentials
     *
     * @return void
     */
    public function test_shoppers_can_log_in_with_correct_credentials()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });

        $response = $this->post(route('login'), [
            'email' => $shopper->email,
            'password' => 'password',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('shoppers.index'));
        $this->assertAuthenticatedAs($shopper);
    }

    /**
     * Test if shoppers cannot log in with incorrect credentials
     *
     * @return void
     */
    public function test_shoppers_cannot_log_in_with_incorrect_credentials()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });

        $response = $this->from(route('login'))
            ->post(route('login'), [
                'email' => $shopper,
                'password' => 'wrong-password',
            ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /**
     * Test if shoppers cannot log in with nonexistent credentials
     *
     * @return void
     */
    public function test_shoppers_cannot_log_in_with_nonexistent_credentials()
    {
        $response = $this->from(route('login'))
            ->post(route('login'), [
                'email' => 'doesnt-exist-email',
                'password' => 'wrong-password',
            ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /**
     * Test if shoppers can log out
     *
     * @return void
     */
    public function test_shoppers_can_log_out()
    {
        $shopper = Shopper::withoutEvents(function () {
            return Shopper::factory()->create();
        });

        $this->actingAs($shopper);

        $this->post(route('logout'));

        $this->assertGuest();
    }
}
