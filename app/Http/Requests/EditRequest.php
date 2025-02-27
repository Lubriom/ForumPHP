<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\File;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('user');

        return [
            'name' => ['required', 'string', 'min:3', 'max:20', 'unique:users,name,' . $userId],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $userId],
            'img_perfil' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:10240'],
            'password' => ['nullable', Rules\Password::defaults()],
        ]; 
         
        if (auth()->user->hasRole('admin')) {
            $rules['rol'] = ['required', 'string', 'in:admin,editor,user'];
        }
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
            'img_perfil.image' => 'El archivo debe ser una imagen.', 
            'img_perfil.max' => 'El archivo no puede tener más de 10MB.', 
            'img_perfil.mimes' => 'El archivo debe tener una extensión válida (jpeg, png, jpg, webp).', 
            'img_perfil.nullable' => 'La imagen de perfil es opcional.',
            'password.required' => 'La contraseña es obligatorio.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.max' => 'La contraseña no puede tener más de 255 caracteres.',
            'password.string' => 'La contraseña debe ser una cadena de texto.',
            'rol.in' => 'El rol debe ser admin, editor o user.',
            'rol.string' => 'El rol debe ser una cadena de texto.',
        ];
    }
}
