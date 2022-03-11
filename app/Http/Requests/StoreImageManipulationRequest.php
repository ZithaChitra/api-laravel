<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class ResizeImageRequest extends FormRequest
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
        $rules =  [
            'image' => ['required'],
            'w' => ['required', 'regex:/^\d+(\.\d+)?%?/'],
            'h' => ['regex:/^\d+(\.\d+)?%?/'],
            'album_id' => ['exists:\App\Models\Album,id']
        ];

        $image = $this->post('image');

        if($image && $image instanceof UploadedFile){
            $rules['image'][] = 'image';
        }
        else{
            $rules['image'][] = 'url';
        }


        echo '<pre>';
        var_dump($rules);
        echo '</pre>';
        exit();

        return $rules;
    }
}

