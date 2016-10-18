<?php

namespace App\Http\Transformers;

use Delta\DeltaService\Measurements\MeasurementModel;
use League\Fractal\TransformerAbstract;

class MeasurementTransformer extends TransformerAbstract
{
    /**
     * Turn item into generic array.
     *
     * @param MeasurementModel $measurement
     * @return array
     */
    public function transform(MeasurementModel $measurement)
    {
        return [
            'id'         => $measurement->getAttribute('id'),
            'value'      => $measurement->getAttribute('value'),
            'created_at' => $measurement->getAttribute('created_at'),
        ];
    }
}
