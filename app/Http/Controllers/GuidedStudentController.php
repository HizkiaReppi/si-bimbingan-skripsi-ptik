<?php

namespace App\Http\Controllers;

use App\Models\Guidance;
use App\Models\Student;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

class GuidedStudentController extends Controller
{
    public function __construct()
    {
        if (!Gate::allows('student')) {
            abort(403);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $students = Student::where('lecturer_id_1', auth()->user()->lecturer->id)
            ->orWhere('lecturer_id_2', auth()->user()->lecturer->id)
            ->get();

        return view('dashboard.mahasiswa-bimbingan.index', compact('students'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $mahasiswa_bimbingan): View
    {
        $guidances = Guidance::where('student_id', $mahasiswa_bimbingan->id)->get();
        return view('dashboard.mahasiswa-bimbingan.show', compact('mahasiswa_bimbingan', 'guidances'));
    }
}
