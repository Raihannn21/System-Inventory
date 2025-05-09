<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'identification_number' => 'required|string|max:255|unique:students',
            'email' => 'required|email|unique:students',
            'password' => 'required|string|min:8|confirmed',
            'program_study_id' => 'required|exists:program_studies,id',
            'school_class_id' => 'required|exists:school_classes,id',
            'captcha.required' => 'Kolom captcha wajib diisi!',
            'captcha.captcha' => 'Jawaban captcha salah, mohon diisi dengan benar!',
        ];
    }
}
