<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuidanceStoreRequest;
use App\Http\Requests\GuidanceUpdateRequest;
use App\Http\Requests\SetGuidanceUpdateRequest;
use App\Models\Guidance;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SetGuidanceController extends Controller
{
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
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $thesis_title = null;

        $latestGuidance = Guidance::where('student_id', auth()->user()->student->id)
            ->latest()
            ->first();

        if ($latestGuidance) {
            $thesis_title = $latestGuidance->thesis_title;
        }

        return view('dashboard.bimbingan.create', compact('thesis_title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GuidanceStoreRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $student = auth()->user()->student;

        DB::beginTransaction();

        try {
            $bimbingan = new Guidance();
            $bimbingan->thesis_title = $validatedData['judul-skripsi'];
            $bimbingan->student_id = $student->id;
            $bimbingan->topic = $validatedData['topik'];
            $bimbingan->schedule = $validatedData['jadwal'];

            if (isset($validatedData['catatan'])) {
                $bimbingan->explanation = $validatedData['catatan'];
            }

            if ($request->hasFile('file-skripsi')) {
                $oldImagePath = 'public/file/skripsi/' . $bimbingan->thesis_file;
                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }

                $file = $request->file('file-skripsi');
                $fileName = time() . '-' . $student->nim . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/file/skripsi', $fileName);
                $bimbingan->thesis_file = $fileName;
            }

            $bimbingan->save();

            DB::commit();
            return redirect()->route('dashboard.bimbingan.index')->with('toast_success', 'Bimbingan berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return redirect()->route('dashboard.bimbingan.index')->with('toast_error', 'Bimbingan gagal ditambahkan');
        }
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
     * Show the form for editing the specified resource.
     */
    public function edit(Guidance $atur_jadwal_bimbingan): View
    {
        return view('dashboard.bimbingan.edit', compact('bimbingan'));
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guidance $atur_jadwal_bimbingan): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $atur_jadwal_bimbingan->delete();
            DB::commit();
            return redirect()->route('dashboard.atur-jadwal-bimbingan.index')->with('toast_success', 'Bimbingan berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard.atur-jadwal-bimbingan.index')->with('toast_error', 'Bimbingan gagal dihapus');
        }
    }
}
