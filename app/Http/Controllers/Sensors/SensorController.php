<?php

namespace App\Http\Controllers\Sensors;

use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Transformers\DeviceTransformer;
use Delta\DeltaService\Devices\DeviceRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Transformers\SensorTransformer;
use Delta\DeltaService\Sensors\SensorRepositoryInterface;
use App\Jobs\StoreSensor;
use App\Http\Requests\Sensors\SensorStoreRequest;

class SensorController extends Controller
{

    private $sensorRepository;


    protected $transformer = SensorTransformer::class;

    public function __construct(SensorRepositoryInterface $sensorRepository)
    {
        $this->sensorRepository = $sensorRepository;
    }

    public function index() {
        $result = $this->sensorRepository->createModel();

        return $this->response->item(
            $result,
            $this->createTransformer()
        );
    }

    public function show() {
        //... TODO
    }

    public function store(SensorStoreRequest $request) {
        $requestArray = $request->all();
        $this->dispatch((new StoreSensor($requestArray))->onQueue('sensor-queue'));

        return $this->response->created();
    }

    public function update() {
        //... TODO
    }

    public function destroy() {
        //... TODO
    }
}
