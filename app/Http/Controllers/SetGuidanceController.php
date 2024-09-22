<?php

namespace App\Http\Controllers;

use App\Http\Requests\SetGuidanceUpdateRequest;
use App\Models\Guidance;
use App\Models\Thesis;
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
        $lecturerId = auth()->user()->lecturer->id;

        $students = Student::where('lecturer_id_1', $lecturerId)
            ->orWhere('lecturer_id_2', $lecturerId)
            ->with([
                'firstSupervisor',
                'secondSupervisor',
                'guidance' => function ($query) use ($lecturerId) {
                    $query->where(function ($q) use ($lecturerId) {
                        $q->where('lecturer_id', $lecturerId);
                    })->with(['student', 'student.user']);
                },
            ])
            ->get();

        $guidances = [];

        foreach ($students as $student) {
            $nonEmptyGuidances = $student->guidance->filter(fn($guidance) => !is_null($guidance));

            if ($nonEmptyGuidances->isNotEmpty()) {
                $guidances[$student->id] = $nonEmptyGuidances;
            }
        }

        return view('dashboard.atur-jadwal-bimbingan.index', compact('guidances'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Guidance $atur_jadwal_bimbingan): View
    {
        return view('dashboard.atur-jadwal-bimbingan.show', compact('atur_jadwal_bimbingan'));
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
            $atur_jadwal_bimbingan->status_request = $validatedData['status_request'];

            if (isset($validatedData['catatan-hasil-review'])) {
                $atur_jadwal_bimbingan->lecturer_notes = $validatedData['catatan-hasil-review'];
            }

            if ($request->hasFile('thesis_file_review')) {
                $file = $request->file('thesis_file_review');
                $fileName = time() . '-' . $atur_jadwal_bimbingan->student->nim . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/file/skripsi/review', $fileName);
                $atur_jadwal_bimbingan->thesis_file_review = $fileName;
            }

            if($atur_jadwal_bimbingan->guidance_number >= 6 && $validatedData['status_request'] == 'approved') {
                $lecture = $atur_jadwal_bimbingan->student->firstSupervisor->id == auth()->user()->lecturer->id ? 'approval_lecturer_1' : 'approval_lecturer_2';

                $thesis = Thesis::where('student_id', $atur_jadwal_bimbingan->student_id)->latest()->first();

                $thesis->$lecture = 'approved';
                $thesis->save();
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
