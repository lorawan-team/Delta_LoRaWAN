<?php

namespace App\Http\Requests\Measurements;

use App\Http\Requests\Request;

class MeasurementUpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'measurement_id' => 'required|integer|max:10',
            'value' => 'required',
        ];
    }
}
