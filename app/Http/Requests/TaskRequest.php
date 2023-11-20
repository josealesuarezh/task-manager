<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=> 'sometimes|string',
            'date' => 'sometimes|date',
            'priority'=> 'sometimes|integer',
            'project_id' => 'sometimes|nullable|integer',
        ];
    }
}
