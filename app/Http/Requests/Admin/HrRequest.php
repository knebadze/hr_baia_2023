<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class HrRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'number' => ['required', 'size:9', 'unique:users'],
            'password' => ['required', 'string', 'min:8',],
            'date_of_birth' => ['required', 'date', 'before:-18 years'],
            'gender_id' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'სახელი და გვარის შევსება სავალდებულოა',
            'email.required' => 'იმეილის შევსება სავალდებულოა',
            'email.email' => 'იმეილი აუცილებლად უნდა შეიცავდეს "@" სიმბოლოს',
            'email.unique' => 'იმეილი უკვე გამოყენებულია',
            'number.required' => 'ნომრის შევსება სავალდებულოა',
            'number.size' => 'ნომრის უნდა შეიცავდეს 9 ციფრს',
            'number.unique' => 'ნომერი უკვე გამოყენებულია',
            'password.required' => 'პაროლის შევსება სავალდებულოა',
            'password.min' => 'პაროლი უნდა შედგებოდეს მინიმუმ 8 სიმბოლოსგან',
            'date_of_birth.required' => 'შევსება სავალდებულოა',
            'date_of_birth.before' => 'თქვენ არ ხართ სრულწლოვანი',
            'gender_id.required' => 'შევსება სავალდებულოა',
        ];
    }
}
