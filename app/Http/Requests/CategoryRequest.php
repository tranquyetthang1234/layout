<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class CategoryRequest extends FormRequest
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
            'name' => 'required|unique:category,name|min: 3'.$this->get('id'),
        ];
    }

     public function messages()
    {
        return [
            'name.min'      => 'Vui lòng nhập vào lớn hơn 16 kí tự ',
            'name.required' => 'Vui lòng nhập vào tên',
            'name.unique'   => 'Tên danh mục đã tồn tại',
        ];
    }

}
