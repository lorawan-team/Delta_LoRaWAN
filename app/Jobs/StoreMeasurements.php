<?php

namespace App\Jobs;

class StoreMeasurements Extends Job
{
    /**
     * @var array
     */
    protected $data;

    /**
     * Bind instances to the class
     *
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }



    public function handle(MeasurementRepositoryInterface $measurementRepository) {
        $measurementRepository->store($this->data);
    }
}