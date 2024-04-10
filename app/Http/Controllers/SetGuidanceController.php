<?php

namespace App\Http\Controllers;

use App\Http\Requests\SetGuidanceUpdateRequest;
use App\Models\Guidance;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class SetGuidanceController extends Controller
{
    public function __construct()
    {
        if (!Gate::allows('lecturer')) {
            abort(403);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $students = Student::where('lecturer_id', auth()->user()->lecturer->id)->get();
        $guidances = [];

        foreach ($students as $student) {
            $guidance = Guidance::where('student_id', $student->id)
                ->latest()
                ->get();

            $guidances[$student->id] = $guidance;
        }

        return view('dashboard.atur-jadwal-bimbingan.index', compact('guidances'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Guidance $atur_jadwal_bimbingan): View
    {
        $statuses = ['approved' => 'Setujui', 'rejected' => 'Tolak'];
        return view('dashboard.atur-jadwal-bimbingan.show', compact('atur_jadwal_bimbingan', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SetGuidanceUpdateRequest $request, Guidance $atur_jadwal_bimbingan): RedirectResponse
    {
        $validatedData = $request->validated();

        DB::beginTransaction();

        try {
            $atur_jadwal_bimbingan->schedule = $validatedData['jadwal'];
            $atur_jadwal_bimbingan->status = $validatedData['status'];

            if (isset($validatedData['catatan-hasil-review'])) {
                $atur_jadwal_bimbingan->lecturer_notes = $validatedData['catatan-hasil-review'];
            }

            if ($request->hasFile('thesis_file_review')) {
                $file = $request->file('thesis_file_review');
                $fileName = time() . '-' . $atur_jadwal_bimbingan->student->nim . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/file/skripsi/review', $fileName);
                $atur_jadwal_bimbingan->thesis_file_review = $fileName;
            }

            $atur_jadwal_bimbingan->save();

            DB::commit();
            return redirect()->route('dashboard.atur-jadwal-bimbingan.index')->with('toast_success', 'Bimbingan berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard.atur-jadwal-bimbingan.index')->with('toast_error', 'Bimbingan gagal diperbarui');
        }
    }
}
