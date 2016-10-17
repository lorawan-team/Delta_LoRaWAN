<?php

class GenericTest extends TestCase
{

    /**
     * Test if an error is thrown when a request is made without an account id
     *
     *
     * @TODO AuthToken is disabled during testing, in order to make tests work. this makes this test unusable
     */
//    public function testFailWithoutAccountId()
//    {
//        $this->json('GET', '/device')
//            ->assertResponseStatus(400)
//            ->seeJson([
//            'message' => "No account ID included with request",
//        ]);
//    }

    /**
     * Test if an error is thrown when the given account ID is invalid
     */
    public function testFailWithInvalidAccountId()
    {

        // @TODO not yet implemented!

//        $this->json('GET', '/device?account_id=99999999999999999')->assertResponseStatus(400)->seeJson([
//            'message' => "No account ID included with request",
//        ]);
    }

    // @TODO different sessions for all tests!
}