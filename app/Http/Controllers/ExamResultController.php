<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExamResultStoreRequest;
use App\Models\ExamResult;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExamResultStoreRequest $request): RedirectResponse
    {
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
    public function show(ExamResult $examResult)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExamResult $examResult)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExamResult $examResult)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExamResult $examResult)
    {
        //
    }
}
