<?php

namespace App\Http\Controllers;

use App\Models\ExamResult;
use App\Models\Student;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

class RequestExamResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        if (!Gate::allows('lecturer') && !Gate::allows('admin')) {
            abort(403);
        }

        $requestExams = null;

        if(auth()->user()->role =='admin') {
            $requestExams = ExamResult::with('student', 'student.user', 'thesis')->get();
        }

        if(auth()->user()->role =='lecturer') {
            $lecturer = auth()->user()->lecturer;

            $students = Student::where('lecturer_id_1', $lecturer->id)
                ->orWhere('lecturer_id_2', $lecturer->id)
                ->get();

            $requestExams = ExamResult::whereIn('student_id', $students->pluck('id'))->with('student', 'student.user', 'thesis')->get();
        }

        return view('dashboard.pengajuan-ujian-hasil-mahasiswa.index', compact('requestExams'));
    }
}
