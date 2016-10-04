<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use Delta\DeltaService\Devices\DeviceModel;

class DeviceTransformer extends TransformerAbstract
{
    /**
     * Turn item into generic array.
     *
     * @param DeviceModel $device
     * @return array
     */
    public function transform(DeviceModel $device)
    {
        return [
            'id'          => $device->getAttribute('id'),
            'name'        => $device->getAttribute('name'),
            'alias'       => $device->getAttribute('alias'),
            'description' => $device->getAttribute('description'),
        ];
    }
}
