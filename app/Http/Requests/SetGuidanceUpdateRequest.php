<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetGuidanceUpdateRequest extends FormRequest
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
            'jadwal' => ['required', 'date_format:Y-m-d\TH:i', 'after:12 hours', 'before:1 year'],
            'thesis_file_review' => ['nullable', 'file', 'max:5120', 'mimes:pdf,doc,docx'],
            'catatan-hasil-review' => ['nullable', 'string', 'regex:/^[a-zA-Z\s0-9.-]*$/'],
            'status' => ['required', 'string', 'in:approved,rejected'],
        ];
    }
}
