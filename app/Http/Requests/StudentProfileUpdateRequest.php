<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'fullname' => ['required', 'string', 'max:255', 'min:2', 'regex:/^[a-zA-Z\s]*$/'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'foto' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
            'no-hp' => ['nullable', 'string', 'min:9', 'max:20', 'regex:/^08[0-9]*$/'],
            'konsentrasi' => ['required', 'string', 'in:rpl,multimedia,tkj'],
            'alamat' => ['nullable', 'string', 'max:255'],
        ];
    }
}
