<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HiloRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'hiloname' => ['required', 'string', 'max:100' , 'min:3'], 
            'hilomsg' => ['required', 'string', 'max:255', 'min:3'],
        ];
    } 
     
    public function messages()
    {
        return [
            'hiloname.required' => 'El título de hilo es obligatorio.',  
            'hiloname.string' => 'El título debe ser una cadena de texto.',
            'hiloname.max' => 'El título no puede tener más de 100 caracteres.', 
            'hiloname.min' => 'El título debe tener al menos 3 caracteres.',
            'hilomsg.required' => 'El contenido del hilo es obligatorio.', 
            'hilomsg.string' => 'El mensaje debe ser una cadena de texto.', 
            'hilomsg.max' => 'El mensaje no puede tener más de 255 caracteres.',  
            'hilomsg.min' => 'El mensaje debe tener al menos 3 caracteres.',
        ];
    }
}
