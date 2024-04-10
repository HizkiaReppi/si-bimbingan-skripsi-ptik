<?php

namespace App\Http\Controllers;

use App\Http\Requests\SetGuidanceActivityUpdateRequest;
use App\Models\Guidance;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

class GuidanceActivityController extends Controller
{
    public function __construct()
    {
        if (!Gate::allows('HoD')) {
            abort(403);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $latestGuidances = Guidance::latest()->get();
        $guidances = collect([]);
        $groupedGuidances = $latestGuidances->groupBy('student_id');

        foreach ($groupedGuidances as $group) {
            $guidances->add($group->first());
        }

        return view('dashboard.aktivitas-bimbingan.index', compact('guidances'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Guidance $aktivitas_bimbingan): View
    {
        $guidances = Guidance::where('student_id', $aktivitas_bimbingan->student->id)->get();
        return view('dashboard.aktivitas-bimbingan.show', compact('aktivitas_bimbingan', 'guidances'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guidance $aktivitas_bimbingan): View
    {
        $statuses = ['pending' => 'Diajukan', 'approved' => 'Setujui', 'rejected' => 'Tolak'];
        return view('dashboard.aktivitas-bimbingan.edit', compact('aktivitas_bimbingan', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SetGuidanceActivityUpdateRequest $request, Guidance $aktivitas_bimbingan)
    {
        $validatedData = $request->validated();

        DB::beginTransaction();

        try {
            $aktivitas_bimbingan->schedule = $validatedData['jadwal'];
            $aktivitas_bimbingan->status = $validatedData['status'];

            if (isset($validatedData['catatan-hasil-review'])) {
                $aktivitas_bimbingan->lecturer_notes = $validatedData['catatan-hasil-review'];
            }

            if ($request->hasFile('thesis_file_review')) {
                $file = $request->file('thesis_file_review');
                $fileName = time() . '-' . $aktivitas_bimbingan->student->nim . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/file/skripsi/review', $fileName);
                $aktivitas_bimbingan->thesis_file_review = $fileName;
            }

            $aktivitas_bimbingan->save();

            DB::commit();
            return redirect()->route('dashboard.aktivitas-bimbingan.index')->with('toast_success', 'Bimbingan berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard.aktivitas-bimbingan.index')->with('toast_error', 'Bimbingan gagal diperbarui');
        }
    }
}
