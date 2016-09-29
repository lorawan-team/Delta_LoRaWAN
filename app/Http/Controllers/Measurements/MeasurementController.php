<?php

namespace App\Http\Controllers\Measurements;

use App\Jobs\StoreMeasurements;
use App\Http\Requests\Device\MeasurementStoreRequest;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Transformers\DeviceTransformer;
use Delta\DeltaService\Devices\DeviceRepositoryInterface;
use App\Http\Controllers\Controller;
use Delta\DeltaService\Measurements\MeasurementRepositoryInterface;
use App\Http\Transformers\MeasurementTransformer;


class MeasurementController extends Controller
{

    private $measurementRepository;

    protected $transformer = MeasurementTransformer::class;

    public function __construct(MeasurementRepositoryInterface $measurementRepository)
    {
        $this->measurementRepository = $measurementRepository;
    }

    public function index($deviceId) {
        $result = $this->measurementRepository->findAll($deviceId);

        return $this->response->collection(
            $result,
            $this->createTransformer()
        );
    }

    public function show($id) {
        $result = $this->measurementRepository->findById($id);

        return $this->response->item(
            $result,
            $this->createTransformer()
        );
    }

    public function store(MeasurementStoreRequest $request) {
        $requestArray = $request->all();
        $this->dispatch((new StoreMeasurements($requestArray))->onQueue('measurement-queue'));

        return $this->response->created();
    }

    public function destroy($id)
    {
        $this->measurementRepository->deleteById($id);
    }
}
