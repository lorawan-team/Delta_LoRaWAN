<?php

namespace App\Http\Requests\Measurements;

use App\Http\Requests\Request;

class MeasurementStoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sensor_id' => 'required|integer|max:10',
            'value' => 'required',
        ];
    }
}
