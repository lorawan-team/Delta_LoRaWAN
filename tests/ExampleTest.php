<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    public function setup()
    {
        parent::setUp();

//        Route::enableFilters();

//        Auth::loginUsingId(1);
    }
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $response = $this->call('GET', '1/measurements?account_id=1');
        $this->assertNotEmpty($response);
    }
}
