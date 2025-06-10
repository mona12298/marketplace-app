<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
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
            'item_name' => 'required',
            'description' => 'required|max:250',
            'image_url' => 'required|image|mimes:jpeg,png',
            'categories' => 'bail|required|array',
            'condition' => 'required',
            'price' => 'required|integer|min:0',
        ];
    }

    public function messages(){
        return [
            'item_name.required' => '商品名を入力してください',
            'description.required' => '商品説明を入力してください',
            'image_url.required' => '画像を選択してください',
            'image_url.mimes' => '画像はJPEGまたはPNG形式でアップロードしてください',
            'categories.required' => '商品のカテゴリーを選択してください',
            'categories.array' => '商品のカテゴリーを選択してください',
            'condition.required' => '商品の状態を選択してください',
            'price.required' => '商品価格を入力してください',
            'price.integer' => '商品価格を数字で入力してください',
            'price.min' => '商品価格を0円以上で入力してください'
        ];
    }
}
