<?php

namespace App\Http\Requests\Sensors;

use App\Http\Requests\Request;

class SensorUpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:45',
            'alias' => 'sometimes',
            'description' => 'sometimes',
        ];
    }
}