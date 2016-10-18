<?php

namespace App\Http\Requests\Devices;

use App\Http\Requests\Request;

class DeviceStoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'max:45',
            'eui' => 'sometimes',
            'alias' => 'max:45',
            'token' => 'max:20',
            'description' => 'sometimes',
        ];
    }
}
