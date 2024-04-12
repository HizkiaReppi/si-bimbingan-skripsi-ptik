<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class GuidanceUpdateRequest extends FormRequest
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
            'judul-skripsi' => ['required', 'string', 'max:255', 'min:10', 'regex:/^[a-zA-Z\s0-9()]*$/'],
            'topik' => ['required', 'string', 'max:255', 'min:5', 'regex:/^[a-zA-Z\s0-9()]*$/'],
            'jadwal' => ['required', 'date_format:Y-m-d\TH:i', 'after:' . Carbon::now()->addHours(12)->format('Y-m-d\TH:i')],
            'file-skripsi' => ['nullable', 'file', 'max:5120', 'mimes:pdf,doc,docx'],
            'catatan' => ['nullable', 'string', 'max:255', 'regex:/^[a-zA-Z\s0-9.-()]*$/'],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     */
    public function messages(): array
    {
        return [
            'jadwal.after' => 'Jadwal bimbingan harus lebih dari 12 jam dari sekarang.',
            'file-skripsi.mimes' => 'File skripsi harus berformat pdf, doc, atau docx.',
            'file-skripsi.max' => 'File skripsi tidak boleh lebih besar dari 5120 kilobytes.',
            'judul-skripsi.regex' => 'Judul skripsi hanya boleh berisi huruf, angka, dan tanda kurung.',
            'topik.regex' => 'Topik hanya boleh berisi huruf, angka, dan tanda kurung.',
            'catatan.regex' => 'Catatan hanya boleh berisi huruf, angka, tanda baca, dan tanda kurung.',
        ];
    }
}
