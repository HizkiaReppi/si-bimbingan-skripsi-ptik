<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Lecturer;
use App\Models\Guidance;
use App\Models\ExamResult;
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
        if (!Gate::allows('admin')) {
            abort(403);
        }

        $totalStudents = Student::count();
        $totalLecturers = Lecturer::count();
        $totalGuidances = Guidance::count();
        $studentsWithTheses = Student::has('guidance')->get();
        $totalApprovedExamResults = ExamResult::where('status_request', 'approved')->count();

        return view('dashboard.index', compact('studentsWithTheses', 'totalStudents',  'totalLecturers', 'totalGuidances', 'totalApprovedExamResults'));
    }
}
