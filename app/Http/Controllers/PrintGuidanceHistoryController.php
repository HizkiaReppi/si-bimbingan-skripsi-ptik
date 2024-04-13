<?php

namespace App\Http\Controllers;

use App\Models\Guidance;
use Illuminate\Http\Request;
use App\Models\HeadOfDepartement;
use Illuminate\View\View;

class PrintGuidanceHistoryController extends Controller
{
    public function index(Request $request): View
    {
        $student = auth()->user()->student;
        $lecturer_id = null;

        if ($request->routeIs('dashboard.bimbingan-1.print')) {
            $lecturer_id = $student->firstSupervisor->id;
        }

        if ($request->routeIs('dashboard.bimbingan-2.print')) {
            $lecturer_id = $student->secondSupervisor->id;
        }

        $guidances = Guidance::where('student_id', $student->id)
            ->where('lecturer_id', $lecturer_id)
            ->get();

        $headOfDepartement = HeadOfDepartement::first();

        return view('dashboard.print.kartu-bimbingan.index', compact('student', 'guidances', 'headOfDepartement'));
    }
}
