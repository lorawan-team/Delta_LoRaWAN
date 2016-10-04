<?php

namespace App\Http\Controllers\Devices;

use App\Http\Transformers\DeviceTransformer;
use Delta\DeltaService\Devices\DeviceRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Devices\DeviceStoreRequest;
use App\Http\Requests\Devices\DeviceUpdateRequest;
use App\Http\Requests\Devices\DeviceIndexRequest;
use App\Jobs\StoreDevice;


class DeviceController extends Controller
{

    private $deviceRepository;

    protected $transformer = DeviceTransformer::class;

    public function __construct(DeviceRepositoryInterface $deviceRepository)
    {
        $this->deviceRepository = $deviceRepository;
    }

    /**
     * List all devices
     *
     * @param DeviceIndexRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function index(DeviceIndexRequest $request) {
        $userId = $request->get("account_id");

        $result = $this->deviceRepository->findAll($userId);

        return $this->response->collection(
            $result,
            $this->createTransformer()
        );
    }

    /**
     * Show a specific device
     *
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function show($id) {
        $result = $this->deviceRepository->findById($id);

        return $this->response->item(
            $result,
            $this->createTransformer()
        );
    }

    /**
     * Add a new sensor
     *
     * @param DeviceStoreRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function store(DeviceStoreRequest $request) {
        $requestArray = $request->all();
        $this->dispatch((new StoreDevice($requestArray))->onQueue('device-queue'));

        return $this->response->created();
    }

    /**
     * Update a given
     *
     * @param int $id
     * @param DeviceUpdateRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function update($id, DeviceUpdateRequest $request) {
        $model = $this->deviceRepository->findById($id);

        if(! isset($model)) {
            return $this->response->error('Device not found', 404);
        }

        $this->deviceRepository->update($model, $request->all());

        return $this->response->accepted();
    }

    /**
     * Delete a device
     *
     * @param $id
     * @return \Dingo\Api\Http\Response|void
     */
    public function destroy($id) {
        $this->deviceRepository->deleteById($id);

        return $this->response->noContent();
    }
}
