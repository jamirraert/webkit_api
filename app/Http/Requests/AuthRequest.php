<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
        $route = $this->route()->getName();

        switch($route) {
            case 'auth.login':
                return $this->LoginRule();
            case 'auth.register':
                return $this->RegisterRule();
            default:
                return [];
        }
    }

    public function messages():array
    {
        return [
            'email.exists' => 'Email not found.',
            'email.unique' => 'Email already exist.'
        ];
    }

    public function LoginRule():array
    {
        return [
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ];
    }

    public function RegisterRule():array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8'
        ];
    }
}
