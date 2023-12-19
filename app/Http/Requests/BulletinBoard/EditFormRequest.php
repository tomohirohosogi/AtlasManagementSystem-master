<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class EditFormRequest extends FormRequest
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
            'post_title' => 'required|string|max:1000',
            'post_body' => 'required|string|max:5000',
        ];
    }

    public function messages(){
        return [
            'post_title.required' => 'タイトルの入力は必須です。',
            'post_title.string' => 'タイトルは文字列で記入してください。',
            'post_title.max' => 'タイトルは1000文字以内で入力してください。',
            'post_body.required' => '投稿内容の入力は必須です。',
            'post_body.string' => '投稿内容は文字列で記入してください。',
            'post_body.max' => '最大文字数は5000文字です。',
        ];
    }
}
