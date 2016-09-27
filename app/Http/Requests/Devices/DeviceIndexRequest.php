<?php

namespace App\Http\Requests\Devices;

use App\Http\Requests\Request;

class DeviceIndexRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'sometimes|alphanum|max:10',
        ];
    }
}
