<?php

namespace App\Http\Controllers;

use App\Http\Requests\LecturerStoreRequest;
use App\Http\Requests\LecturerUpdateRequest;
use App\Models\Lecturer;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class LecturerController extends Controller
{
    public function __construct()
    {
        if (!Gate::allows('admin')) {
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

        $lecturers = Lecturer::all();
        return view('dashboard.lecturer.index', compact('lecturers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('dashboard.lecturer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LecturerStoreRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        DB::beginTransaction();

        try {
            $user = new User();
            $user->name = $validatedData['fullname'];
            $user->email = $validatedData['email'];
            $user->username = $validatedData['nidn'];
            $user->password = Hash::make($validatedData['nidn']);
            $user->role = 'lecturer';
            $user->save();

            $lecturer = new Lecturer();
            $lecturer->user_id = $user->id;
            $lecturer->nip = $validatedData['nip'];
            $lecturer->nidn = $validatedData['nidn'];
            $lecturer->front_degree = $validatedData['gelar-depan'];
            $lecturer->back_degree = $validatedData['gelar-belakang'];
            $lecturer->position = $validatedData['jabatan'];
            $lecturer->rank = $validatedData['pangkat'];
            $lecturer->type = $validatedData['golongan'];
            $lecturer->phone_number = $validatedData['no-hp'];
            $lecturer->save();

            DB::commit();

            return redirect()->route('dashboard.lecturer.index')->with('toast_success', 'Lecturer added successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            return redirect()->back()->withInput()->with('error', 'Failed to add Lecturer. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Lecturer $lecturer): View
    {
        $title = 'Apakah anda yakin?';
        $text = 'Anda tidak akan bisa mengembalikannya!';
        confirmDelete($title, $text);

        $students = Student::where('lecturer_id', $lecturer->id)->get();
        return view('dashboard.lecturer.show', compact('lecturer', 'students'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lecturer $lecturer): View
    {
        return view('dashboard.lecturer.edit', compact('lecturer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LecturerUpdateRequest $request, Lecturer $lecturer)
    {
        $validatedData = $request->validated();

        DB::beginTransaction();

        try {
            if (isset($validatedData['nidn'])) {
                $lecturer->user->username = $validatedData['nidn'];
                $lecturer->nidn = $validatedData['nidn'];
                $lecturer->user->password = Hash::make($validatedData['nidn']);
            }

            if (isset($validatedData['email'])) {
                $lecturer->user->email = $validatedData['email'];
            }

            if (isset($validatedData['nip'])) {
                $lecturer->nip = $validatedData['nip'];
            }

            $lecturer->user->name = $validatedData['fullname'];
            $lecturer->user->save();

            $lecturer->front_degree = $validatedData['gelar-depan'];
            $lecturer->back_degree = $validatedData['gelar-belakang'];
            $lecturer->position = $validatedData['jabatan'];
            $lecturer->rank = $validatedData['pangkat'];
            $lecturer->type = $validatedData['golongan'];
            $lecturer->phone_number = $validatedData['no-hp'];
            $lecturer->save();

            DB::commit();

            return redirect()->route('dashboard.lecturer.index')->with('toast_success', 'Lecturer updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'Failed to update Lecturer. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lecturer $lecturer)
    {
        DB::beginTransaction();

        try {
            $lecturer->delete();
            $lecturer->user->delete();

            DB::commit();

            return redirect()->route('dashboard.lecturer.index')->with('toast_success', 'Lecturer deleted successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Failed to delete Lecturer. Please try again.');
        }
    }
}
