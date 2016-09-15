<?php

namespace App\Http\Controllers\Devices;

use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Transformers\DeviceTransformer;
use Delta\DeltaService\Devices\DeviceRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Transformers\SensorTransformer;
use Delta\DeltaService\Sensors\SensorRepositoryInterface;

class SensorController extends Controller
{

    private $sensorRepository;


    protected $transformer = SensorTransformer::class;

    public function __construct(SensorRepositoryInterface $deviceRepository)
    {
        $this->deviceRepository = $deviceRepository;
    }

    public function index() {
        $result = $this->deviceRepository->createModel();

        return $this->response->item(
            $result,
            $this->createTransformer()
        );
    }

    public function show() {
        //... TODO
    }

    public function store() {
        //... TODO
    }

    public function update() {
        //... TODO
    }

    public function destroy() {
        //... TODO
    }
}
