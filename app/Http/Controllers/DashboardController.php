<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Lecturer;
use App\Models\Guidance;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|RedirectResponse
    {
        if (auth()->user()->role == 'student') {
            return redirect()->route('dashboard.bimbingan.index');
        } elseif (auth()->user()->role == 'lecturer') {
            return redirect()->route('dashboard.atur-jadwal-bimbingan.index');
        } elseif (auth()->user()->role == 'HoD') {
            return redirect()->route('dashboard.aktivitas-bimbingan.index');
        } else {
            $totalStudents = Student::count();
            $totalLecturers = Lecturer::count();
            $totalGuidances = Guidance::count();
            $studentsWithTheses = Student::has('guidance')->get();

            return view('dashboard.index', compact('studentsWithTheses', 'totalStudents',  'totalLecturers', 'totalGuidances'));
        }
    }
}
