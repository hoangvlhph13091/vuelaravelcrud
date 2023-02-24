<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'price' => 'required',
            'postID' => 'required',
            'content' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Tên Không Được Để Trống',
            'price.required'=>'Giá Tiền Không Được Để Trống',
            'postID.required'=>'Danh Mục Không Được Để Trống',
            'content.required'=>'Content Không Được Để Trống'
        ];
    }

}
