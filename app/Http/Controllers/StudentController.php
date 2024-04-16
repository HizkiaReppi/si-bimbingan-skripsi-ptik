<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Models\Guidance;
use App\Models\Student;
use App\Models\User;
use App\Models\Lecturer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class StudentController extends Controller
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

        $students = Student::all();
        return view('dashboard.student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $lecturers = Lecturer::all();
        $concentrations = ['rpl', 'multimedia', 'tkj'];
        return view('dashboard.student.create', compact('lecturers', 'concentrations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentStoreRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        DB::beginTransaction();

        try {
            $user = new User();
            $user->name = $validatedData['fullname'];
            $user->username = $validatedData['nim'];
            $user->email = $validatedData['email'];
            $user->password = Hash::make($validatedData['nim']);
            $user->role = 'student';

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $fileName = time() . '_mahasiswa_' . $user->username . '.' . $file->getClientOriginalExtension();

                $file->storeAs('public/images/profile-photo', $fileName);

                $user->photo = $fileName;
            }

            $user->save();

            $student = new Student();
            $student->user_id = $user->id;
            $student->lecturer_id_1 = $validatedData['lecturer_id_1'];
            $student->lecturer_id_2 = $validatedData['lecturer_id_2'];
            $student->nim = $validatedData['nim'];
            $student->batch = $validatedData['angkatan'];
            $student->concentration = $validatedData['konsentrasi'];
            $student->phone_number = $validatedData['no-hp'];
            $student->address = $validatedData['alamat'];

            $student->save();

            DB::commit();
            return redirect()->route('dashboard.student.index')->with('toast_success', 'Student added successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('toast_error', 'Failed to add Student. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $mahasiswa): View
    {
        $title = 'Apakah anda yakin?';
        $text = 'Anda tidak akan bisa mengembalikannya!';
        confirmDelete($title, $text);

        $guidances = Guidance::where('student_id', $mahasiswa->id)->get();

        return view('dashboard.student.show', compact('mahasiswa', 'guidances'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $mahasiswa): View
    {
        $lecturers = Lecturer::all();
        $concentrations = ['rpl', 'multimedia', 'tkj'];
        return view('dashboard.student.edit', compact('mahasiswa', 'lecturers', 'concentrations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentUpdateRequest $request, Student $mahasiswa): RedirectResponse
    {
        $validatedData = $request->validated();

        DB::beginTransaction();

        try {
            if (isset($validatedData['nim'])) {
                $mahasiswa->user->username = $validatedData['nim'];
                $mahasiswa->nim = $validatedData['nim'];
                $mahasiswa->user->password = Hash::make($validatedData['nim']);
            }

            if (isset($validatedData['email'])) {
                $mahasiswa->user->email = $validatedData['email'];
            }

            if ($request->hasFile('foto')) {
                $oldImagePath = 'public/images/profile-photo/' . $mahasiswa->user->photo;
                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }

                $file = $request->file('foto');
                $fileName = time() . '_mahasiswa_' . $mahasiswa->user->username . '.' . $file->getClientOriginalExtension();

                $file->storeAs('public/images/profile-photo', $fileName);

                $mahasiswa->user->photo = $fileName;
            }

            $mahasiswa->user->name = $validatedData['fullname'];
            $mahasiswa->user->save();

            $mahasiswa->lecturer_id_1 = $validatedData['lecturer_id_1'];
            $mahasiswa->lecturer_id_2 = $validatedData['lecturer_id_2'];
            $mahasiswa->batch = $validatedData['angkatan'];
            $mahasiswa->concentration = $validatedData['konsentrasi'];
            $mahasiswa->phone_number = $validatedData['no-hp'];
            $mahasiswa->address = $validatedData['alamat'];

            $mahasiswa->save();

            DB::commit();
            return redirect()->route('dashboard.student.index')->with('toast_success', 'Student updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('toast_error', 'Failed to update Student. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $mahasiswa): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $mahasiswa->delete();
            $mahasiswa->user->delete();

            DB::commit();

            // delete foto
            $oldImagePath = 'public/images/profile-photo/' . $mahasiswa->user->foto;
            if (Storage::exists($oldImagePath)) {
                Storage::delete($oldImagePath);
            }

            return redirect()->route('dashboard.student.index')->with('toast_success', 'Student deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('toast_error', 'Failed to delete Student. Please try again.');
        }
    }
}
