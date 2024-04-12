<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExamResultStoreRequest;
use App\Models\ExamResult;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

class ExamResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        if (!Gate::allows('HoD')) {
            abort(403);
        }

        $requestExams = ExamResult::where('status_request', 'pending')->latest()->take(50)->get();
        $approvedExams = ExamResult::where('status_request', 'approved')->latest()->take(50)->get();

        return view('dashboard.ujian-hasil.index', compact('requestExams', 'approvedExams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExamResultStoreRequest $request): RedirectResponse
    {
        if (!Gate::allows('student')) {
            abort(403);
        }

        $validatedData = $request->validated();

        DB::beginTransaction();

        try {
            $examResult = new ExamResult();

            $examResult->student_id = $validatedData['student_id'];
            $examResult->thesis_id = $validatedData['thesis_id'];
            $examResult->guidance_id = $validatedData['guidance_id'];

            $examResult->save();

            DB::commit();
            return redirect()->route('dashboard.bimbingan.index')->with('toast_success', 'Berhasil melakukan request ujian.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal melakukan request ujian. Silahkan coba lagi!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ExamResult $ujian): View
    {
        if (!Gate::allows('HoD')) {
            abort(403);
        }

        return view('dashboard.ujian-hasil.show', compact('ujian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExamResult $ujian)
    {
        if (!Gate::allows('HoD')) {
            abort(403);
        }

        $validatedData = $request->validate([
            'status_request' => ['required', 'in:approved,pending'],
        ]);

        DB::beginTransaction();

        try {
            $ujian->status_request = $validatedData['status_request'];
            $ujian->save();

            DB::commit();
            return redirect()->route('dashboard.ujian.index')->with('toast_success', 'Berhasil mengubah status pengajuan ujian.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal mengubah status pengajuan ujian. Silahkan coba lagi!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExamResult $ujian)
    {
        if (!Gate::allows('student')) {
            abort(403);
        }

        DB::beginTransaction();

        try {
            $ujian->delete();

            DB::commit();
            return redirect()->route('dashboard.bimbingan.index')->with('toast_success', 'Berhasil menghapus pengajuan ujian.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus pengajuan ujian. Silahkan coba lagi!');
        }
    }
}
