<?php

namespace App\Http\Requests\Device;

use App\Http\Requests\Request;

class MeasurementStoreRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'value' => 'required',
            'sensor_id' => 'required|integer|max:10'
        ];
    }
}
