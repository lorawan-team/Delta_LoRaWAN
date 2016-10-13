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
            'name' => 'required|max:45',
            'uuid' => 'required',
            'alias' => 'required|max:45',
            'token' => 'required|max:20',
        ];
    }
}
