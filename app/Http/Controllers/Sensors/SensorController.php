<?php

namespace App\Http\Controllers\Sensors;

use App\Http\Requests\Sensors\SensorUpdateRequest;
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

    /**
     * List all sensors
     *
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function index($id) {
        $result = $this->sensorRepository->findAll($id);

        return $this->response->collection(
            $result,
            $this->createTransformer()
        );
    }

    /**
     * Show a specific sensor
     *
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function show($id) {
        $result = $this->sensorRepository->findById($id);

        return $this->response->item(
            $result,
            $this->createTransformer()
        );
    }

    /**
     * Add a new Sensor
     *
     * @param SensorStoreRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function store(SensorStoreRequest $request) {
        $requestArray = $request->all();
        $this->dispatch((new StoreSensor($requestArray))->onQueue('sensor-queue'));

        return $this->response->created();
    }

    /**
     * Update a given sensor
     *
     * @param $id
     * @param SensorUpdateRequest $request
     * @return \Dingo\Api\Http\Response|void
     */
    public function update($id, SensorUpdateRequest $request) {
        $model = $this->sensorRepository->findById($id);

        if(! isset($model)) {
            return $this->response->error('Sensor not found', 404);
        }

        $this->sensorRepository->update($model, $request->all());

        return $this->response->accepted();
    }

    /**
     * Delete a sensor
     *
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function destroy($id) {
        $this->sensorRepository->deleteById($id);

        return $this->response->noContent();
    }
}