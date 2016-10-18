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
     * @param SensorModelInterface $sensor
     * @return array
     */
    public function transform(SensorModelInterface $sensor)
    {
        return [
            'id'          =>      $sensor->getAttribute('id'),
            'device_id'   =>      $sensor->getAttribute('device_id'),
            'name'        =>      $sensor->getAttribute('name'),
            'alias'       =>      $sensor->getAttribute('alias'),
            'description' =>      $sensor->getAttribute('description'),
        ];
    }
}
