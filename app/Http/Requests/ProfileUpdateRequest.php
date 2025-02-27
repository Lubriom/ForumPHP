<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:20', Rule::unique(User::class)->ignore($this->user()->id)],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'img_perfil' =>
            File::image()->min(10)->max(12 * 1024)->dimensions(Rule::dimensions()->maxWidth(1500)->maxHeight(1000)),
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'name.max' => 'El nombre no puede tener más de 20 caracteres.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.unique' => 'Ya existe un con este nombre.',
            'email.required' => 'El campo correo es obligatorio.',
            'email.email' => 'El campo correo debe ser una dirección de correo electrónico válida.',
            'email.lowercase' => 'El campo correo debe estar en minúsculas.',
            'email.max' => 'El correo no puede tener más de 255 caracteres.',
            'email.string' => 'El campo correo debe ser una cadena de texto.',
            'email.unique' => 'Ya existe un usuarios con este correo',
            'img_perfil.image' => 'El archivo debe ser una imagen.',
            'img_perfil.max' => 'El archivo no puede tener más de 10MB.',
        ];
    }
}
