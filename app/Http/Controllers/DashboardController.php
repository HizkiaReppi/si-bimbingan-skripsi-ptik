<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Lecturer;
use App\Models\Guidance;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|RedirectResponse
    {
        if (auth()->user()->role == 'student') {
            if (!Gate::allows('student')) {
                abort(403);
            }

            return redirect()->route('dashboard.bimbingan.index');
        } elseif (auth()->user()->role == 'lecturer') {
            if (!Gate::allows('lecturer')) {
                abort(403);
            }

            return redirect()->route('dashboard.atur-jadwal-bimbingan.index');
        } elseif (auth()->user()->role == 'HoD') {
            if (!Gate::allows('HoD')) {
                abort(403);
            }

            return redirect()->route('dashboard.aktivitas-bimbingan.index');
        } else {
            if (!Gate::allows('admin')) {
                abort(403);
            }

            $totalStudents = Student::count();
            $totalLecturers = Lecturer::count();
            $totalGuidances = Guidance::count();
            $studentsWithTheses = Student::has('guidance')->get();

            return view('dashboard.index', compact('studentsWithTheses', 'totalStudents',  'totalLecturers', 'totalGuidances'));
        }
    }
}
