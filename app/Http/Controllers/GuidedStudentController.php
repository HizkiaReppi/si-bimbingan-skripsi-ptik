<?php

namespace App\Http\Controllers;

use App\Models\Guidance;
use App\Models\Student;
use Illuminate\View\View;

class GuidedStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $students = Student::where('lecturer_id', auth()->user()->lecturer->id)->get();

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
