<?php

namespace App\Http\Requests\Roles;

use App\Http\Requests\Request;

class RoleUpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'role' => 'required|max:45',
        ];
    }
}
