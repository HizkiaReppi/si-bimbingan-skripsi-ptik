<?php

namespace App\Http\Requests;

use App\Models\Student;
use App\Models\Thesis;
use App\Models\Guidance;
use Illuminate\Foundation\Http\FormRequest;

class ExamResultStoreRequest extends FormRequest
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
            'student_id' => ['required', 'exists:' . Student::class . ',id'],
            'thesis_id' => ['required', 'exists:' . Thesis::class . ',id'],
            'guidance_id' => ['required', 'exists:' . Guidance::class . ',id'],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     */
    public function messages(): array
    {
        return [
            'student_id.exists' => 'The selected mahasiswa is invalid.',
            'thesis_id.exists' => 'The selected tugas akhir is invalid.',
            'guidance_id.exists' => 'The selected bimbingan is invalid.',
        ];
    }
}
