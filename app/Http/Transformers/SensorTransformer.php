<?php

namespace App\Http\Transformers;

use Delta\DeltaService\Measurements\MeasurementModelInterface;
use League\Fractal\TransformerAbstract;
use Delta\DeltaService\Devices\DeviceModelInterface;
use Delta\DeltaService\Roles\RoleModelInterface;
use Delta\DeltaService\Sensors\SensorModelInterface;

class SensorTransformer extends TransformerAbstract
{
    /**
     * Turn item into generic array.
     *
     * @param SensorModelInterface $device
     * @return array
     */
    public function transform(SensorModelInterface $device)
    {
        return [
            'id' => $device->getAttribute('id'),
            'name' => $device->getAttribute('name'),
        ];
    }
}
