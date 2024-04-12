<?php

namespace App\Http\Requests;

use Carbon\Carbon;
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
            'jadwal' => ['required', 'date_format:Y-m-d\TH:i', 'after:' . Carbon::now()->addHour()->format('Y-m-d\TH:i')],
            'thesis_file_review' => ['nullable', 'file', 'max:5120', 'mimes:pdf,doc,docx'],
            'catatan-hasil-review' => ['nullable', 'string'],
            'status_request' => ['required', 'string', 'in:approved,pending'],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     */
    public function messages(): array
    {
        return [
            'jadwal.after' => 'Jadwal bimbingan harus lebih dari 1 jam dari sekarang.',
            'thesis_file_review.mimes' => 'File skripsi harus berformat pdf, doc, atau docx.',
            'thesis_file_review.max' => 'File skripsi tidak boleh lebih besar dari 5120 kilobytes.',
            'status_request.in' => 'Status request bimbingan hanya boleh "Setujui" atau "Diajukan".',
        ];
    }
}
