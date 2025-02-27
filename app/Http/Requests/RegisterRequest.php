<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest; 
use Illuminate\Validation\Rules\File;
use App\Models\User; 
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:20', 'unique:' . User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'img_perfil' => [
                'required',
                File::image()
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    } 

     public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',  
            'name.min' => 'El campo nombre debe tener al menos 3 caracteres.',
            'name.max' => 'El campo nombre no puede tener más de 20 caracteres.', 
            'name.string' => 'El campo nombre debe ser una cadena de texto.',  
            'name.unique' => 'Ya existe un con este nombre.',
            'email.email' => 'El campo correo debe ser una dirección de correo electrónico válida.', 
            'email.lowercase' => 'El campo correo debe estar en minúsculas.', 
            'email.max' => 'El correo no puede tener más de 255 caracteres.', 
            'email.string' => 'El campo correo debe ser una cadena de texto.', 
            'email.unique' => 'Ya existe un usuarios con este correo',
            'email.required' => 'El campo correo es obligatorio.',
            'img_perfil.required' => 'La imagen de perfil es obligatoria.', 
            'img_perfil.image' => 'El archivo debe ser una imagen.',
            'password.required' => 'La contraseña es obligatorio.', 
            'password.confirmed' => 'Las contraseñas no coinciden.', 
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.', 
            'password.max' => 'La contraseña no puede tener más de 255 caracteres.', 
            'password.string' => 'La contraseña debe ser una cadena de texto.', 
        ];
    }
}
