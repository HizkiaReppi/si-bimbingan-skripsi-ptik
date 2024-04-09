<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Models\Student;
use App\Models\User;
use App\Models\Lecturer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
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
                $fileName = time() . '_' . $user->username . '.' . $file->getClientOriginalExtension();

                $file->storeAs('public/images/profile-photo', $fileName);

                $user->photo = $fileName;
            }

            $user->save();

            $student = new Student();
            $student->user_id = $user->id;
            $student->lecturer_id = $validatedData['lecturer_id'];
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
            dd($e->getMessage());
            return redirect()->back()->withInput()->with('toast_error', 'Failed to add Student. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student): View
    {
        $title = 'Apakah anda yakin?';
        $text = 'Anda tidak akan bisa mengembalikannya!';
        confirmDelete($title, $text);
        
        return view('dashboard.student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student): View
    {
        $lecturers = Lecturer::all();
        $concentrations = ['rpl', 'multimedia', 'tkj'];
        return view('dashboard.student.edit', compact('student', 'lecturers', 'concentrations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentUpdateRequest $request, Student $student): RedirectResponse
    {
        $validatedData = $request->validated();

        DB::beginTransaction();

        try {
            if (isset($validatedData['nim'])) {
                $student->user->username = $validatedData['nim'];
                $student->nim = $validatedData['nim'];
                $student->user->password = Hash::make($validatedData['nim']);
            }

            if(isset($validatedData['email'])) {
                $student->user->email = $validatedData['email'];
            }

            if ($request->hasFile('foto')) {
                $oldImagePath = 'public/images/profile-photo/' . $student->user->photo;
                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }
                
                $file = $request->file('foto');
                $fileName = time() . '_' . $student->user->username . '.' . $file->getClientOriginalExtension();
                
                $file->storeAs('public/images/profile-photo', $fileName);
                
                $student->user->photo = $fileName;
            }
            
            $student->user->name = $validatedData['fullname'];
            $student->user->save();

            $student->lecturer_id = $validatedData['lecturer_id'];
            $student->batch = $validatedData['angkatan'];
            $student->concentration = $validatedData['konsentrasi'];
            $student->phone_number = $validatedData['no-hp'];
            $student->address = $validatedData['alamat'];

            $student->save();

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
    public function destroy(Student $student): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $student->delete();
            $student->user->delete();

            DB::commit();

            // delete foto
            $oldImagePath = 'public/images/profile-photo/' . $student->foto;
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
