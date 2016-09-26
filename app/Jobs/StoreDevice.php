<?php

namespace App\Jobs;

use Delta\DeltaService\Devices\DeviceRepositoryInterface;

class StoreDevice Extends Job
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

    public function handle(DeviceRepositoryInterface $deviceRepository) {
        $deviceRepository->store($this->data);
    }
}