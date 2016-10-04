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
     * @param RoleModelInterface $role
     * @return array
     */
    public function transform(RoleModelInterface $role)
    {
        return [
            'id'   => $role->getAttribute('id'),
            'role' => $role->getAttribute('role'),
        ];
    }
}
