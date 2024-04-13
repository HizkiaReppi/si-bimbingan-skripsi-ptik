<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeadOfDepartement;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

class PrintExamApprovalController extends Controller
{
    public function index(Request $request): View
    {
        if (!Gate::allows('student')) {
            abort(403);
        }

        $student = auth()->user()->student;
        $headOfDepartement = HeadOfDepartement::first();

        return view('dashboard.print.persetujuan-ujian.index', compact('student', 'headOfDepartement'));
    }
}
