<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePegawaiRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:100'],
            'email' => ['required', 'unique:users', 'max:100'],
            'password' => ['required', 'max:100'],
            'alamat' => ['required', 'max:100'],
            'telepon' => ['required', 'max:100'],
            'role'=> ['required', Rule::in(['admin','pegawai'])],
        ];
    }
}
