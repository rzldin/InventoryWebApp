<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadImageRequest extends FormRequest
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
        return  [
                    'coverImage.*' => 'image|mimes:png,jpg,jpeg,gif,svg|max:2048',
                    'coverImage' => 'min:3',
                ];
    } 

    public function messages() {
        return [
            // 'coverImage.*.max' => 'Image size should be less than 2mb',
            'coverImage.*.mimes' => 'Only jpeg, png, bmp,tiff files are allowed.',
            'coverImage.min' => 'Minimal upload 3 gambar'
        ];
    }
}
