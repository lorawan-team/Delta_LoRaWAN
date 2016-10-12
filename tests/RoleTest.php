<?php

use App\Jobs\StoreRole;

/**
 * Testclass for role API related methods
 *
 * @coversDefaultClass App\Http\Controllers\Roles\RoleController
 * @package Tests\API
 */
class RoleTest extends TestCase
{

    // ------------------- SUCCESS TESTS ----------------------------//

    /**
     * List all available roles
     *
     * @covers ::index()
     * @medium
     * @uses RoleRepository::findAll()
     */
    public function testListRoles()
    {
        $this->get('/role?account_id=1')
            ->assertResponseStatus(200);
    }

    /**
     * Get a specific, existing role
     *
     * @covers ::show($id)
     * @medium
     * @uses RoleRepository::findById($id)
     */
    public function testGetSpecificRole()
    {
        $this->get('/role/1?account_id=1')
            ->assertResponseStatus(200);
    }

    /**
     * Add a new, valid, role.
     *
     * @covers ::store($id)
     * @medium
     */
    public function testAddRole()
    {
        $this->expectsJobs(StoreRole::class);
        $this->post('/role?account_id=1', [
            'role' => 'testRole',
        ])->assertResponseStatus(201);
    }

    /**
     * Update an already existing role with valid data
     *
     * @covers ::update($id)
     * @medium
     * @uses RoleRepository::findById($id)
     * @uses RoleRepository::update($model, $data)
     */
    public function testUpdateRole()
    {
        $this->put('/role/1?account_id=1', [
            'role' => 'testRoleUpdated',
        ])
            ->assertResponseStatus(202);
    }

    /**
     * Remove an existing role that is not being used by a user
     *
     * @covers ::destroy($id)
     * @medium
     * @uses RoleRepository::deleteById($id)
     */
    public function testRemoveUnusedRole()
    {
        $this->delete('/role/11?account_id=1')
            ->assertResponseStatus(204);
    }

    // ------------------- FAILURE TESTS ----------------------------//

    /**
     * Update a role that does not exist
     *
     * @covers ::update($id)
     * @medium
     * @uses RoleRepository::findById($id)
     */
//    public function testUpdateNotExistingRole()
//    {
//        $this->put('/role/100?account_id=1', [
//            'role' => 'testRoleUpdated',
//        ])
//            ->assertResponseStatus(404);
//    }

    /**
     * Remove an existing role that is still in use
     *
     * @covers ::destroy($id)
     * @medium
     * @uses RoleRepository::deleteById($id)
     */
    public function testDeleteRoleBeingUsed()
    {
        $result = $this->delete('/role/1?account_id=1');
         //   ->assertResponseStatus(409);
        dd($result);
    }
}