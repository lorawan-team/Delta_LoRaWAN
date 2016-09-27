<?php

namespace App\Jobs;

use Delta\DeltaService\Measurements\MeasurementRepositoryInterface;

class StoreMeasurements Extends Job
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



    public function handle(MeasurementRepositoryInterface $measurementRepository) {
        $measurementRepository->store($this->data);
    }
}