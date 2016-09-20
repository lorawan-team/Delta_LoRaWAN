<?php

namespace App\Http\Controllers\Devices;

use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Transformers\DeviceTransformer;
use Delta\DeltaService\Devices\DeviceRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Device\DeviceStoreRequest;


class DeviceController extends Controller
{

    private $deviceRepository;

    protected $transformer = DeviceTransformer::class;

    public function __construct(DeviceRepositoryInterface $deviceRepository)
    {
        $this->deviceRepository = $deviceRepository;
    }

    /**
     * @return \Dingo\Api\Http\Response
     */
    public function index() {
        $result = $this->deviceRepository->createModel();

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
        $result = $this->deviceRepository->store($request['name']);

        return $this->response->item(
            $result,
            $this->createTransformer()
        );
    }

    public function update() {
        //... TODO
    }

    public function destroy() {
        //... TODO
    }
}
