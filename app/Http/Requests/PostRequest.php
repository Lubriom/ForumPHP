<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'postmsg' => ['required', 'string', 'max:255', 'min:3'],
        ];
    } 
     
    public function messages()
    {
        return [
            'postmsg.required' => 'El contenido del hilo es obligatorio.', 
            'postmsg.string' => 'El mensaje debe ser una cadena de texto.', 
            'postmsg.max' => 'El mensaje no puede tener más de 255 caracteres.',  
            'postmsg.min' => 'El mensaje debe tener al menos 3 caracteres.',
        ];
    }
}
