<?php

namespace App\Http\Controllers\Devices;

use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
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
     * @param DeviceIndexRequest $request
     *
     * @return \Dingo\Api\Http\Response
     */
    public function index(DeviceIndexRequest $request) {
        $result = $this->deviceRepository->findAll((array) $request);

        return $this->response->item(
            $result,
            $this->createTransformer()
        );
    }

    /**
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
     * @param DeviceStoreRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function store(DeviceStoreRequest $request) {
        $requestArray = $request->all();
        $this->dispatch((new StoreDevice($requestArray))->onQueue('device-queue'));

        return $this->response->created();
    }

    /**
     * @param int $id
     * @param DeviceUpdateRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function update($id, DeviceUpdateRequest $request) {
        $model = $this->deviceRepository->findById($id);

        if(! isset($model)) {
            return $this->response->error('Device not found', 404);
        }

        $this->deviceRepository->update($model, (array) $request);

        return $this->response->accepted();
    }

    /**
     * @param $id
     * @return \Dingo\Api\Http\Response|void
     */
    public function destroy($id) {
        $model = $this->deviceRepository->findById($id);

        if(! isset($model)) {
            return $this->response->error('Device not found', 404);
        }

        $this->deviceRepository->delete($model);

        return $this->response->accepted();
    }
}
