<?php

namespace App\Http\Requests\Sensors;

use App\Http\Requests\Request;

class SensorStoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'device_id' => 'required|integer|max:10',
            'name' => 'required|max:255',
        ];
    }
}
