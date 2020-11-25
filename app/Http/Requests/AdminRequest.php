<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
            // 'course'       => 'required',
            // 'course_unit'  => 'required',
            // 'course_code'  => 'required',
            // 'Programmes'   => 'required',
            // 'semester_Id'  => 'required',
            // 'type'         => 'required',
            // 'borrowable'   => '',
            // 'borrowed_to'  => 'required_if:borrowable,on',
            // 'dep_course'   => '',
            // 'dep_on'       => 'required_if:dep_course,on',
            'name'         => 'required|string|max:191',
            'email'        => 'required|string|email|max:191|unique:users',
            'password'     => 'required|string|min:6',
        ];
    }
}
