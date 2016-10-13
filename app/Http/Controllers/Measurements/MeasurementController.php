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
     * @param int $deviceUuid
     * @return \Dingo\Api\Http\Response
     */
    public function index($deviceUuid)
    {
        $result = $this->measurementRepository->findAll($deviceUuid);

        return $this->response->collection(
            $result,
            $this->createTransformer()
        );
    }

    /**
     * Show a specific measurement
     *
     * @param String $deviceUuid
     * @param int $id
     * @return \Dingo\Api\Http\Response
     */
    public function show($deviceUuid, $id)
    {
        $result = $this->measurementRepository->findById($deviceUuid);

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
    public function store(MeasurementStoreRequest $request)
    {
        $requestArray = $request->all();
        $this->dispatch((new StoreMeasurements($requestArray))->onQueue('measurement-queue'));

        return $this->response->created();
    }

    /**
     * Delete a measurement
     *
     * @param int $deviceUuid
     * @param int $id
     * @return \Dingo\Api\Http\Response
     */
    public function destroy($deviceUuid, $id)
    {
        $this->measurementRepository->deleteById($id);
        return $this->response->noContent();
    }
}
