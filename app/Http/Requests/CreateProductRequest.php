<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
        $rules = [
            'name' => 'required|min:3|max:255',
            'category_id' => 'required',
            'picture'=> 'required|image|mimes:jpeg,bmp,png',
            'info' => 'required'
        ];
        // $photos = count($this->input('photos'));
        // foreach(range(0, $photos) as $index) {
        //     $rules['photos.' . $index] = 'image|mimes:jpeg,bmp,png|max:2000';
        // }
        return $rules;
    }
}
