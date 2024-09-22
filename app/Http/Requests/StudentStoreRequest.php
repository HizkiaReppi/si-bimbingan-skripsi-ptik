<?php

namespace App\Http\Requests;

use App\Models\Lecturer;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StudentStoreRequest extends FormRequest
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
            'nim' => ['required', 'string', 'max:10', 'min:4', 'unique:' . Student::class, 'regex:/^[0-9]*$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'min:4', 'unique:' . User::class],
            'angkatan' => ['required', 'integer', 'digits:4', 'min:1900', 'max:' . (date('Y'))],
            'konsentrasi' => ['required', 'string', 'in:rpl,multimedia,tkj'],
            'no-hp' => ['nullable', 'string', 'min:9', 'max:20', 'regex:/^08[0-9]*$/'],
            'alamat' => ['nullable', 'string', 'max:255'],
            'foto' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
            'lecturer_id_1' => ['required', 'exists:' . Lecturer::class . ',id'],
        ];

        if ($this->lecturer_id_2 && $this->lecturer_id_2 != "choose") {
            $rules['lecturer_id_2'] = ['required', 'exists:' . Lecturer::class . ',id', 'different:lecturer_id_1'];
        } else {
            $rules['lecturer_id_2'] = ['nullable'];
        }

        return $rules;
    }

    /**
     * Get the validation messages that apply to the request.
     */
    public function messages(): array
    {
        return [
            'fullname.regex' => 'The nim field must be alphabet.',
            'nim.unique' => 'The nim field must be unique.',
            'nim.regex' => 'The nim field must be number.',
            'no-hp.regex' => 'The nim field must be number telephone.',
            'konsentrasi.in' => 'The konsentrasi field must be one of the following: rpl, multimedia, tkj.',
            'lecturer_id_1.exists' => 'The selected dosen pembimbing 1 is invalid.',
            'lecturer_id_2.exists' => 'The selected dosen pembimbing 2 is invalid.',
            'lecturer_id_2.different' => 'The dosen pembimbing 2 and dosen pembimbing 1 must be different.',
        ];
    }
}
