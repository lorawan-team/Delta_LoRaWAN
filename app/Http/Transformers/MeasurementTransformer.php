<?php

namespace App\Http\Transformers;

use Delta\DeltaService\Measurements\MeasurementModelInterface;
use League\Fractal\TransformerAbstract;
use Delta\DeltaService\Devices\DeviceModelInterface;

class MeasurementTransformer extends TransformerAbstract
{
    /**
     * Turn item into generic array.
     *
     * @param MeasurementModelInterface $device
     * @return array
     */
    public function transform(MeasurementModelInterface $device)
    {
        return [
            'test' => $device->getTest(),
        ];
    }
}
