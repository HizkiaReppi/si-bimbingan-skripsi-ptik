<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuidanceStoreRequest extends FormRequest
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
            'judul-skripsi' => ['required', 'string', 'max:255', 'min:10', 'regex:/^[a-zA-Z\s0-9]*$/'],
            'topik' => ['required', 'string', 'max:255', 'min:5', 'regex:/^[a-zA-Z\s0-9]*$/'],
            'jadwal' => ['required', 'date_format:Y-m-d\TH:i', 'after:12 hours', 'before:1 year'],
            'file-skripsi' => ['required', 'file', 'max:5120', 'mimes:pdf,doc,docx'],
            'catatan' => ['nullable', 'string', 'max:255', 'regex:/^[a-zA-Z\s0-9.-]*$/'],
        ];
    }
}
