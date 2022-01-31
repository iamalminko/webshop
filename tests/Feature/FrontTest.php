<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FrontTest extends TestCase
{
    /**
     * Test if home route exists
     *
     * @return void
     */
    public function test_home()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    /**
     * Check if shop route exists
     *
     * @return void
     */
    public function test_shop()
    {
        $response = $this->get('/shop');

        $response->assertStatus(200);
    }
    /**
     * Check if cart route exists
     *
     * @return void
     */
    public function test_cart()
    {
        $response = $this->get('/cart');

        // Response is 302 because the tester is not logged in and Auth will redirect it to home page
        $response->assertStatus(302);
    }
    /**
     * Check if dashboard route exists
     *
     * @return void
     */
    public function test_dashboard()
    {
        $response = $this->get('/dashboard');

        // Response is 302 because the tester is not logged in and Auth will redirect it to home page
        $response->assertStatus(302);
    }
}
