<?php

namespace App\Http\Controllers\Measurements;

use App\Http\Requests\Measurements\MeasurementStoreRequest;
use App\Http\Controllers\Controller;
use Delta\DeltaService\Measurements\MeasurementRepositoryInterface;
use App\Http\Transformers\MeasurementTransformer;
use App\Jobs\StoreMeasurements;


class MeasurementController extends Controller
{

    private $measurementRepository;

    protected $transformer = MeasurementTransformer::class;

    public function __construct(MeasurementRepositoryInterface $measurementRepository)
    {
        $this->measurementRepository = $measurementRepository;
    }

    /**
     * List all measurements
     *
     * @param int $measurementId
     * @return \Dingo\Api\Http\Response
     */
    public function index($measurementId) {
        $result = $this->measurementRepository->findAll($measurementId);

        return $this->response->collection(
            $result,
            $this->createTransformer()
        );
    }

    /**
     * Show a specific measurement
     *
     * @param int $deviceId
     * @param int $id
     * @return \Dingo\Api\Http\Response
     */
    public function show($deviceId, $id) {
        $result = $this->measurementRepository->findById($id);

        return $this->response->item(
            $result,
            $this->createTransformer()
        );
    }

    /**
     * Add a new measurement. does not require a token.
     *
     * @param MeasurementStoreRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function store(MeasurementStoreRequest $request) {
        $requestArray = $request->all();
        $this->dispatch((new StoreMeasurements($requestArray))->onQueue('measurement-queue'));

        return $this->response->created();
    }

    /**
     * Delete a measurement
     *
     * @param int $deviceId
     * @param int $id
     * @return \Dingo\Api\Http\Response
     */
    public function destroy($deviceId, $id)
    {
        $this->measurementRepository->deleteById($id);
        return $this->response->noContent();
    }
}
