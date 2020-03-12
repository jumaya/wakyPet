<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMascota extends FormRequest
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
            'nombre' => 'required|string|max:128',
            'raza' => 'required',
            'fecha_nacimiento' => 'required|date',          
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8000',
        ];
    }
}
