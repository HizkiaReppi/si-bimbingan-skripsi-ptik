<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuidanceStoreRequest;
use App\Http\Requests\GuidanceUpdateRequest;
use App\Models\ExamResult;
use App\Models\Guidance;
use App\Models\Thesis;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class GuidanceController extends Controller
{
    public function __construct()
    {
        if (!Gate::allows('student')) {
            abort(403);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $title = 'Apakah anda yakin?';
        $text = 'Anda tidak akan bisa mengembalikannya!';
        confirmDelete($title, $text);

        $student = auth()->user()->student;

        if (request()->routeIs('dashboard.bimbingan-1.index')) {
            $guidances = Guidance::where('student_id', $student->id)->where('lecturer_id', $student->firstSupervisor->id)->get();
            return view('dashboard.bimbingan.dosen-pembimbing-1.index', compact('guidances'));
        } elseif (request()->routeIs('dashboard.bimbingan-2.index')) {
            $guidances = Guidance::where('student_id', $student->id)->where('lecturer_id', $student->secondSupervisor->id)->get();
            return view('dashboard.bimbingan.dosen-pembimbing-2.index', compact('guidances'));
        } else {
            $guidances = Guidance::where('student_id', $student->id)->get();
            $thesis = Thesis::where('student_id', $student->id)->latest()->first();

            $totalGuidance1 = Guidance::where('student_id', $student->id)
                ->where('lecturer_id', $student->firstSupervisor->id)
                ->count();

            $totalGuidance2 = Guidance::where('student_id', $student->id)
                ->where('lecturer_id', $student->secondSupervisor->id)
                ->count();

            $latestGuidance = Guidance::where('student_id', $student->id)
                ->latest()
                ->first();

            $examResult = ExamResult::where('student_id', $student->id)
                ->where('thesis_id', $thesis->id)
                ->first();

            $title = 'Apakah anda yakin?';
            $text = 'Data pengajuan ujian Anda akan dihapus!';
            confirmDelete($title, $text);

            return view('dashboard.bimbingan.index', compact('guidances', 'latestGuidance', 'thesis', 'totalGuidance1', 'totalGuidance2', 'examResult'));
        }
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
            $thesis_title = $latestGuidance->thesis->title;
        }

        if (request()->routeIs('dashboard.bimbingan-1.create')) {
            return view('dashboard.bimbingan.dosen-pembimbing-1.create', compact('thesis_title'));
        } elseif (request()->routeIs('dashboard.bimbingan-2.create')) {
            return view('dashboard.bimbingan.dosen-pembimbing-2.create', compact('thesis_title'));
        } else {
            return view('dashboard.bimbingan.create', compact('thesis_title'));
        }
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
            $latestThesis = Thesis::where('student_id', $student->id)
            ->latest()
            ->first();

            $bimbingan = new Guidance();
            
            if ($latestThesis && $latestThesis->title != $validatedData['judul-skripsi']) {
                $thesis = new Thesis();
                $thesis->student_id = $student->id;
                $thesis->title = $validatedData['judul-skripsi'];

                if ($request->hasFile('file-skripsi')) {
                    $oldImagePath = 'public/file/skripsi/' . $thesis->file;
                    if (Storage::exists($oldImagePath)) {
                        Storage::delete($oldImagePath);
                    }
    
                    $file = $request->file('file-skripsi');
                    $fileName = time() . '-' . $student->nim . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('public/file/skripsi', $fileName);
                    $thesis->file = $fileName;
                }
    
                $thesis->save();

                $bimbingan->thesis_id = $thesis->id;
            } else {
                $bimbingan->thesis_id = $latestThesis->id;
            }

            if (request()->routeIs('dashboard.bimbingan-1.store')) {
                $bimbingan->lecturer_id = $student->firstSupervisor->id;

                $existingBimbingan = Guidance::where('student_id', $student->id)
                    ->where('lecturer_id', $student->firstSupervisor->id)
                    ->latest()
                    ->first();
                    
            } elseif (request()->routeIs('dashboard.bimbingan-2.store')) {
                $bimbingan->lecturer_id = $student->secondSupervisor->id;

                $existingBimbingan = Guidance::where('student_id', $student->id)
                    ->where('lecturer_id', $student->secondSupervisor->id)
                    ->latest()
                    ->first();
            }

            $bimbingan->student_id = $student->id;
            $bimbingan->topic = $validatedData['topik'];
            $bimbingan->schedule = $validatedData['jadwal'];

            if (isset($validatedData['catatan'])) {
                $bimbingan->explanation = $validatedData['catatan'];
            }

            if (!$existingBimbingan || $existingBimbingan->guidance_number == null) {
                $bimbingan->guidance_number = 1;
            } else {
                $bimbingan->guidance_number = $existingBimbingan->guidance_number + 1;
            }

            $bimbingan->save();

            DB::commit();
            if (request()->routeIs('dashboard.bimbingan-1.store')) {
                return redirect()->route('dashboard.bimbingan-1.index')->with('toast_success', 'Bimbingan berhasil ditambahkan');
            } elseif (request()->routeIs('dashboard.bimbingan-2.store')) {
                return redirect()->route('dashboard.bimbingan-2.index')->with('toast_success', 'Bimbingan berhasil ditambahkan');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            if (request()->routeIs('dashboard.bimbingan-1.store')) {
                return redirect()->route('dashboard.bimbingan-1.index')->with('toast_error', 'Bimbingan gagal ditambahkan');
            } elseif (request()->routeIs('dashboard.bimbingan-2.store')) {
                return redirect()->route('dashboard.bimbingan-2.index')->with('toast_error', 'Bimbingan gagal ditambahkan');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Guidance $bimbingan): View
    {
        if (request()->routeIs('dashboard.bimbingan-1.show')) {
            return view('dashboard.bimbingan.dosen-pembimbing-1.show', compact('bimbingan'));
        } elseif (request()->routeIs('dashboard.bimbingan-2.show')) {
            return view('dashboard.bimbingan.dosen-pembimbing-2.show', compact('bimbingan'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guidance $bimbingan): View
    {
        if (request()->routeIs('dashboard.bimbingan-1.edit')) {
            return view('dashboard.bimbingan.dosen-pembimbing-1.edit', compact('bimbingan'));
        } elseif (request()->routeIs('dashboard.bimbingan-2.edit')) {
            return view('dashboard.bimbingan.dosen-pembimbing-2.edit', compact('bimbingan'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GuidanceUpdateRequest $request, Guidance $bimbingan): RedirectResponse
    {
        $validatedData = $request->validated();

        DB::beginTransaction();

        try {
            $bimbingan->thesis->title = $validatedData['judul-skripsi'];
            $bimbingan->topic = $validatedData['topik'];
            $bimbingan->schedule = $validatedData['jadwal'];

            if (isset($validatedData['catatan'])) {
                $bimbingan->explanation = $validatedData['catatan'];
            }

            if ($request->hasFile('file-skripsi')) {
                $file = $request->file('file-skripsi');
                $fileName = time() . '-' . auth()->user()->student->nim . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/file/skripsi', $fileName);
                $bimbingan->thesis->file = $fileName;
            }

            $bimbingan->save();

            DB::commit();
            if (request()->routeIs('dashboard.bimbingan-1.update')) {
                return redirect()->route('dashboard.bimbingan-1.index')->with('toast_success', 'Bimbingan berhasil diperbarui');
            } elseif (request()->routeIs('dashboard.bimbingan-2.update')) {
                return redirect()->route('dashboard.bimbingan-2.index')->with('toast_success', 'Bimbingan berhasil diperbarui');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            if (request()->routeIs('dashboard.bimbingan-1.update')) {
                return redirect()->route('dashboard.bimbingan-1.index')->with('toast_error', 'Bimbingan gagal diperbarui');
            } elseif (request()->routeIs('dashboard.bimbingan-2.update')) {
                return redirect()->route('dashboard.bimbingan-2.index')->with('toast_error', 'Bimbingan gagal diperbarui');
            }
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
            if (request()->routeIs('dashboard.bimbingan-1.destroy')) {
                return redirect()->route('dashboard.bimbingan-1.index')->with('toast_success', 'Bimbingan berhasil dihapus');
            } elseif (request()->routeIs('dashboard.bimbingan-2.destroy')) {
                return redirect()->route('dashboard.bimbingan-2.index')->with('toast_success', 'Bimbingan berhasil dihapus');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            if (request()->routeIs('dashboard.bimbingan-1.destroy')) {
                return redirect()->route('dashboard.bimbingan-1.index')->with('toast_error', 'Bimbingan gagal dihapus');
            } elseif (request()->routeIs('dashboard.bimbingan-2.destroy')) {
                return redirect()->route('dashboard.bimbingan-2.index')->with('toast_error', 'Bimbingan gagal dihapus');
            }
        }
    }
}
