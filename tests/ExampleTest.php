<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends TestCase
{

    //use DatabaseMigrations;
    //use WithoutMiddleware;

    public function setup()
    {
        parent::setUp();
        Auth::loginUsingId(1);
    }

    //roles - success

    /**
     * List all available rols
     */
    public function testListRoles()
    {
        $this->json('GET', '/roles?account_id=1')
            ->assertResponseStatus(200)
            ->seeJsonEquals([
                'data' => [
                    'id' => 1,
                    'name' => 'DEVICE1'
                ]
            ]);

        // @TODO check for structure and available roles
    }

    //roles - failure

    //devices - success

    //devices - failure

    //sensors - success

    //sensors - failure

    //measurements - success

    //measurements - failure

    //Generic tests
    /**
     * Test if an error is thrown when a request is made without an account id
     *
     *
     * @TODO AuthToken is disabled during testing, in order to make tests work. this makes this test unusable
     */
    public function testFailWithoutAccountId()
    {
//        $this->json('GET', '/device')
//            ->assertResponseStatus(400)
//            ->seeJson([
//            'message' => "No account ID included with request",
//        ]);
    }

    /**
     * Test if an error is thrown when the given account ID is invalid
     */
    public function testFailWithInvalidAccountId()
    {

        // TODO not yet implemented!

//        $this->json('GET', '/device?account_id=99999999999999999')->assertResponseStatus(400)->seeJson([
//            'message' => "No account ID included with request",
//        ]);
    }

    //different sessions!

}
