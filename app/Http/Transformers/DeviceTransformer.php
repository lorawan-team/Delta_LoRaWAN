<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use Delta\DeltaService\Devices\DeviceModel;

class DeviceTransformer extends TransformerAbstract
{
    /**
     * Turn item into generic array.
     *
     * @param DeviceModelInterface $device
     * @return array
     */
    public function transform(DeviceModel $device)
    {
        return [
            'name' => $device->getAttribute('name'),
        ];
    }
}
