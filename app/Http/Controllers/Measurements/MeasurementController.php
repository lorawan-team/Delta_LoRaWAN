<?php

namespace App\Http\Controllers\Measurements;

use App\Jobs\StoreMeasurements;
use App\Http\Requests\Measurements\MeasurementStoreRequest;
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

    /**
     * @param int $deviceId
     * @return \Dingo\Api\Http\Response
     */
    public function index($deviceId) {
        $result = $this->measurementRepository->findAll($deviceId);

        return $this->response->collection(
            $result,
            $this->createTransformer()
        );
    }

    /**
     * @param int $id
     * @return \Dingo\Api\Http\Response
     */
    public function show($id) {
        $result = $this->measurementRepository->findById($id);

        return $this->response->item(
            $result,
            $this->createTransformer()
        );
    }

    /**
     * @param MeasurementStoreRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function store(MeasurementStoreRequest $request) {
        $requestArray = $request->all();
        $this->dispatch((new StoreMeasurements($requestArray))->onQueue('measurement-queue'));

        return $this->response->created();
    }

    /**
     * @param int $id
     * @return \Dingo\Api\Http\Response
     */
    public function destroy($id)
    {
        $this->measurementRepository->deleteById($id);
        return $this->response->noContent();
    }
}
