<?php

namespace App\Jobs;

use Delta\DeltaService\Sensors\SensorRepositoryInterface;

class StoreSensor Extends Job
{
    /**
     * @var array
     */
    protected $data;

    /**
     * Bind instances to the class
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle(SensorRepositoryInterface $sensorRepository) {
        $sensorRepository->store($this->data);
    }
}