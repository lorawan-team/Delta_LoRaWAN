<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use Delta\DeltaService\Devices\DeviceModelInterface;

class DeviceTransformer extends TransformerAbstract
{
    /**
     * Turn item into generic array.
     *
     * @param DeviceModelInterface $device
     * @return array
     */
    public function transform(DeviceModelInterface $device)
    {
        return [
            'test' => $device->getTest(),
        ];
    }
}
