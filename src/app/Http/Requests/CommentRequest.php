<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'content' => 'required|max:255'
        ];
    }

    public function messages(){
        return [
            'content.required' => 'コメントを入力してください',
            'content.max' => '255文字以下で入力してください'
        ];
    }

    public function withValidator($validator){
        $validator->after(function ($validator) {
            if (!auth()->check()) {
                $validator->errors()->add('auth', 'コメントにはログインが必要です');
            }
        });
    }
}