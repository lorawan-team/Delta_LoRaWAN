<?php

namespace App\Http\Transformers;

use Delta\DeltaService\Measurements\MeasurementModelInterface;
use League\Fractal\TransformerAbstract;
use Delta\DeltaService\Devices\DeviceModelInterface;
use Delta\DeltaService\Roles\RoleModelInterface;

class RoleTransformer extends TransformerAbstract
{
    /**
     * Turn item into generic array.
     *
     * @param RoleModelInterface $device
     * @return array
     */
    public function transform(RoleModelInterface $device)
    {
        return [
            'test' => $device->getTest(),
        ];
    }
}
