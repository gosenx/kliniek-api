<?php

namespace App\Http\Requests;

use App\Models\Patient;
use Illuminate\Foundation\Http\FormRequest;

class StorePatient extends FormRequest
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

        $email_rules = 'unique:users|email|nullable';
        $bi_rules = 'unique:users|nullable|max:12|min:11';
        $phone_rules = 'required|unique:users|min:9|max:9';

        //Validating if the unique attributes belongs to the current user
        if ($this->getMethod() == 'PUT') {
            $user_id = Patient::query()->find($this->id)->user->id;
            $email_rules = 'email|nullable|unique:users,email,' . $user_id;
            $bi_rules = 'nullable|string|max:12|min:11|unique:users,bi,' . $user_id;
            $phone_rules = 'required|min:9|max:9|unique:users,phone,' . $user_id;
        }

        return [
            'name' => 'required|string|min:5',
            'bi' => $bi_rules,
            'job_title' => 'nullable|string|min:2',
            'gender' => 'nullable|string',
            'birthday' => 'nullable|date',
            'phone' => $phone_rules,
            'email' => $email_rules,
            'address' => 'nullable|string|min:5',
            'password' => 'nullable|string',
        ];

    }
}
