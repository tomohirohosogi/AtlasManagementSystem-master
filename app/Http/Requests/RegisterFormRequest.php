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
    //ここに年月日を融合させる記述//
    protected function prepareForValidation()
    {
    $birth_day = ($this->filled(['old_year','old_month','old_day',])) ? $this->old_year .'-'. $this->old_month . '-'. $this->old_day : ' ';
    $this->merge([
       'birth_day' => $birth_day

    ]);
    //オブジェクト指向確認、クラス、インスタンス
    return parent::prepareForValidation();
    }


    public function rules()
    {
        return [
            //
            'over_name' => ['required','string','max:10'],
            'under_name' => ['required','string','max:10'],
            'over_name_kana' =>  ['required','string','max:10'],
            'under_name_kana' => ['required','string','max:10'],
            'mail_address' => ['required','email','max:100',],
            //既定のもの以外無効済
            'sex' => ['required','in:1,2,3'],
            //ここに指定した範囲の日付かの記述
            'birth_day' => ['required','date','before_or_equal:today','after_or_equal:2000-01-01',],
            //既定のもの以外無効済
            'role' => ['required','in:1,2,3,4'],
            'password' => ['required','between:8,30','same:password_confirmation',],

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

            //姓
            'over_name.required' => '名前は必須項目です
            ',
            'over_name.string' => '名前は文字列で記入してください',
            'over_name.max' => '名前は10文字以内で記入してください',
            //名
            'under_name.required' => '名前は必須項目です
            ',
            'under_name.string' => '名前は文字列で記入してください',
            'under_name.max' => '名前は10文字以内で記入してください',
            //セイ(カタカナのみ指定未)
            'over_name_kana.required' => '名前は必須項目です
            ',
            'over_name_kana.string' => '名前は文字列で記入してください',
            'over_name_kana.max' => '名前は10文字以内で記入してください',
            //メイ(カタカナのみ指定未)
            'under_name_kana.required' => '名前は必須項目です
            ',
            'under_name_kana.string' => '名前は文字列で記入してください',
            'under_name_kana.max' => '名前は10文字以内で記入してください',
            //メールアドレス
            'mail_address.required' => 'メールアドレスは必須です',
            'mail_address.max' => 'メールアドレスは100文字以内で記入してください',
            'mail_address.email' => 'メールアドレスの形式で入力してください',
            //性別
            'sex.required' => '選択は必須です',
            'sex.in' => '選択は男性、女性、その他以外無効です',
            //生年月日
            'birth_day.required' => '日付は入力必須です',
            'birth_day.date' => '年月日で入力してください',
            'birth_day.before_or_equal' => '指定できる範囲は今日までです',
            'birth_day.after_or_equal' => '指定できる範囲は2000年01月01日からです',


            //選択科目
            'role.required' => '選択は必須です',
            'role.in' => '選択項目以外無効です',
            //パスワード
            'password.required' => 'パスワードは必須です',
            'password.between' => 'パスワードは8文字以上30文字以内で入力してください',
            'password.same' => '確認用パスワードと一致しません',

        ];
    }
}
