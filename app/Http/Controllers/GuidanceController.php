<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuidanceStoreRequest;
use App\Http\Requests\GuidanceUpdateRequest;
use App\Models\Guidance;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GuidanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $title = 'Apakah anda yakin?';
        $text = 'Anda tidak akan bisa mengembalikannya!';
        confirmDelete($title, $text);

        $guidances = Guidance::where('student_id', auth()->user()->student->id)->get();
        return view('dashboard.bimbingan.index', compact('guidances'));
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

            $existingBimbingan = Guidance::where('student_id', $student->id)->latest()->first();

            if (!$existingBimbingan || $existingBimbingan->guidance_number == null) {
                $bimbingan->guidance_number = 1;
            } else {
                $bimbingan->guidance_number = $existingBimbingan->guidance_number + 1;
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
    public function show(Guidance $bimbingan): View
    {
        return view('dashboard.bimbingan.show', compact('bimbingan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guidance $bimbingan): View
    {
        return view('dashboard.bimbingan.edit', compact('bimbingan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GuidanceUpdateRequest $request, Guidance $bimbingan): RedirectResponse
    {
        $validatedData = $request->validated();

        DB::beginTransaction();

        try {
            $bimbingan->thesis_title = $validatedData['judul-skripsi'];
            $bimbingan->topic = $validatedData['topik'];
            $bimbingan->schedule = $validatedData['jadwal'];

            if (isset($validatedData['catatan'])) {
                $bimbingan->explanation = $validatedData['catatan'];
            }

            if ($request->hasFile('file-skripsi')) {
                $file = $request->file('file-skripsi');
                $fileName = time() . '-' . auth()->user()->student->nim . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/file/skripsi', $fileName);
                $bimbingan->thesis_file = $fileName;
            }

            $bimbingan->save();

            DB::commit();
            return redirect()->route('dashboard.bimbingan.index')->with('toast_success', 'Bimbingan berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard.bimbingan.index')->with('toast_error', 'Bimbingan gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guidance $bimbingan): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $bimbingan->delete();
            DB::commit();
            return redirect()->route('dashboard.bimbingan.index')->with('toast_success', 'Bimbingan berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard.bimbingan.index')->with('toast_error', 'Bimbingan gagal dihapus');
        }
    }
}
