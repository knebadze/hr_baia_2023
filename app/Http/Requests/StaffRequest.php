<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'role_id' => 'required|exists:roles,id',
            'parent_id' => 'nullable|exists:staff,id',
            'name' => 'nullable|string',
            'email' => 'nullable|string|email|max:255|unique:staff',
            'number' => 'required|string|unique:staff',
            'date_of_birth' => 'nullable|date',
            'gender_id' => 'nullable|exists:genders,id',
            'avatar' => 'nullable|string',
            'person_number' => 'required|string|max:11',
            'mobile' => 'nullable|string|max:10',
            'inside_number' => 'nullable|string|max:9',
            'bonus_percent' => 'nullable|numeric',
            'fixed_salary' => 'required|integer',
            'branch_id' => 'required|integer',
            'internship' => 'nullable|boolean',
            'fb_link' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'status' => 'nullable|integer',
            'password' => 'required|string|min:8',
        ];
    }
}
