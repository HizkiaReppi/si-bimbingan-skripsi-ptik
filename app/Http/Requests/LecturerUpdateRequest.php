<?php

namespace App\Http\Requests;

use App\Models\Lecturer;
use Illuminate\Foundation\Http\FormRequest;

class LecturerUpdateRequest extends FormRequest
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
        $rules = [
            'fullname' => ['required', 'string', 'max:255', 'min:2', 'regex:/^[a-zA-Z\s]*$/'],
            'gelar-depan' => ['nullable', 'string', 'max:50', 'regex:/^[\pL\s.,]+$/u'],
            'gelar-belakang' => ['nullable', 'string', 'max:50', 'regex:/^[\pL\s.,]+$/u'],
            'jabatan' => ['nullable', 'string', 'max:100', 'regex:/^[a-zA-Z\s]*$/'],
            'pangkat' => ['nullable', 'string', 'max:100', 'regex:/^[a-zA-Z\s.]*$/'],
            'golongan' => ['nullable', 'string', 'max:50', 'regex:/^[a-zA-Z\s.\/]*$/'],
            'no-hp' => ['nullable', 'string', 'min:9', 'max:20', 'regex:/^08[0-9]*$/'],
        ];

        if($this->nidn != $this->lecturer->nidn) {
            $rules['nidn'] = ['required', 'string', 'max:25', 'min:4', 'unique:' . Lecturer::class, 'regex:/^[0-9]*$/'];
        }

        if($this->email != $this->lecturer->user->email) {
            $rules['email'] = ['required', 'string', 'email', 'max:255', 'min:4', 'unique:' . Lecturer::class];
        }

        if($this->nip != $this->lecturer->nip) {
            $rules['nip'] = ['required', 'string', 'max:25', 'min:13', 'unique:' . Lecturer::class, 'regex:/^[0-9]*$/'];
        }

        return $rules;
    }
}
