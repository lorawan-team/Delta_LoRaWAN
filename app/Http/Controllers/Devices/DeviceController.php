<?php

namespace App\Http\Controllers\Devices;

use App\Http\Controllers\Controller;
use App\Http\Requests\Devices\DeviceStoreRequest;
use App\Http\Requests\Devices\DeviceUpdateRequest;
use App\Http\Transformers\DeviceTransformer;
use App\Jobs\StoreDevice;
use Delta\DeltaService\Devices\DeviceRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class DeviceController
 * @package App\Http\Controllers\Devices
 * @Resource("Device")
 */
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
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function index(Request $request)
    {
        $result = $this->deviceRepository->findAll($request->input('account_id'));

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
    public function show($id)
    {
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
    public function store(DeviceStoreRequest $request)
    {
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
    public function update($id, DeviceUpdateRequest $request)
    {
        try {
            $model = $this->deviceRepository->findById($id);
            $this->deviceRepository->update($model, $request->all());
            return $this->response->accepted();
        } catch (ModelNotFoundException $exception) {
            return $this->response->error("the device with the given ID does not exist", 404);
        }
    }

    /**
     * Delete a device
     *
     * @param $id
     * @return \Dingo\Api\Http\Response|void
     */
    public function destroy($id)
    {
        try {
            $this->deviceRepository->deleteById($id);
            return $this->response->noContent();

        } catch (ModelNotFoundException $e) {
            // TODO recursief verwijderen van sensoren en measurements? soft deletes ofc.
            return $this->response->error("Could not delete the device as it is still has a sensor", 409);
        }
    }
}
