<?php

use App\Jobs\StoreDevice;

/**
 * Testclass for device API related methods
 *
 * @coversDefaultClass App\Http\Controllers\Devices\DeviceController
 * @package Tests\API
 */
class DeviceTest extends TestCase
{

    // ------------------- SUCCESS TESTS ----------------------------//

    /**
     * List all available devices
     *
     * @covers ::index()
     * @medium
     * @uses DeviceRepository::findAll()
     */
    public function testListDevices()
    {
        $this->get('/device?account_id=1')
            ->assertResponseStatus(200);

    }

    /**
     * Get a specific, existing device
     *
     * @covers ::show($id)
     * @medium
     * @uses DeviceRepository::findById($id)
     */
    public function testGetSpecificDevice()
    {
        $this->get('/device/1?account_id=1')
            ->assertResponseStatus(200);
    }

    /**
     * Add a new, valid, device.
     *
     * @covers ::store($id)
     * @medium
     */
    public function testAddDevice()
    {
        $this->expectsJobs(StoreDevice::class);
        $this->post('/device?account_id=1', [
            'name' => 'DeviceAddedByATest',
            'uuid' => '00:00:00:00:00:BB:BB',
            'alias' => 'testDevice',
            'token' => '323465746u5662765875',
        ])->assertResponseStatus(201);
    }

    /**
     * Update an already existing device with valid data
     *
     * @covers ::update($id)
     * @medium
     * @uses DeviceRepository::findById($id)
     * @uses DeviceRepository::update($model, $data)
     */
    public function testUpdateDevice()
    {
        $this->put('/device/1?account_id=1', [
            'name' => 'TestDeviceUpdatedName',
        ])
            ->assertResponseStatus(202);
    }

    /**
     * Remove an existing device that is not being used by a sensor
     *
     * @covers ::destroy($id)
     * @medium
     * @uses DeviceRepository::deleteById($id)
     */
    public function testRemoveUnusedDevice()
    {
        $this->delete('/device/11?account_id=1')
            ->assertResponseStatus(204);
    }

    // ------------------- FAILURE TESTS ----------------------------//

    /**
     * Update a device that does not exist
     *
     * @covers ::update($id)
     * @medium
     * @uses DeviceRepository::findById($id)
     */
    public function testUpdateNotExistingDevice()
    {
        $this->put('/device/100?account_id=1', [
            'name' => 'TestDeviceUpdatedName',
        ])
            ->assertResponseStatus(404);
    }

    /**
     * Remove an existing device that is still in use
     *
     * @covers ::destroy($id)
     * @medium
     * @uses DeviceRepository::deleteById($id)
     */
    public function testDeleteDeviceBeingUsed()
    {
//        $result = $this->delete('/device/1?account_id=1');
////            ->assertResponseStatus(409);
//        dd($result);
    }
}