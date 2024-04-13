<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeadOfDepartement;
use Illuminate\View\View;

class PrintExamApprovalController extends Controller
{
    public function index(Request $request): View
    {
        $student = auth()->user()->student;
        $headOfDepartement = HeadOfDepartement::first();

        return view('dashboard.persetujuan-ujian.index', compact('student', 'headOfDepartement'));
    }
}
