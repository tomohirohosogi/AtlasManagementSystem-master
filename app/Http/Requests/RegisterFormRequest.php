<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
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
            //
            'over_name' => 'required|string||',
            'under_name' => 'required|string||',
            'over_name_kana' => 'required|string|',
            'under_name_kana' => 'required|string||',
            'mail_address' => 'required|string|email',
            'sex' => 'required|string||',
            'birth_day' => 'required|string||',
            'role' => 'required|string||',
            'password' => 'required|string|between:8,16',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => '名前は必須項目です',
            'email.email' => 'メールアドレスの形式で入力してください',
            'password.between' => '8文字以上16文字以内で入力してください',
        ];
    }
}
