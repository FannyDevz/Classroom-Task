<?php

namespace App\Http\Requests\StudentClass;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentClassRequest extends FormRequest
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
            'angkatan'      => 'required|min:2',
            'class_name'    => 'required',
            'teacher_id'    => 'integer'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'angkatan.required' => 'Tahun Angkatan tidak boleh dikosongkan',
            'angkatan.min' => 'Angkatan tidak memenuhi kereteria',
            'class_name.required' => 'Kelas tidak boleh dikosongkan',
            'teacher_id.integer' => 'Format guru tidak diterima oleh sistem'            
        ];
    }
}